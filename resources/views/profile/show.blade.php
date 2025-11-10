<!-- resources/views/profile/show.blade.php -->
@extends('layouts.app')

@section('title', 'My Profile - SeiyaSphere')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">My Profile</h1>
        <p class="text-gray-600">Manage your personal information and preferences</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Profile Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Personal Information</h3>
                    <button class="text-purple-600 hover:text-purple-700 text-sm font-medium" onclick="toggleEdit('personalInfo')">
                        Edit
                    </button>
                </div>
                
                <form id="personalInfoForm" action="{{ route('profile.update') }}" method="POST" class="hidden">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                            <input type="text" name="first_name" value="{{ auth()->user()->first_name }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                            <input type="text" name="middle_name" value="{{ auth()->user()->middle_name }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                            <input type="text" name="last_name" value="{{ auth()->user()->last_name }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="tel" name="phone" value="{{ auth()->user()->phone }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                            <textarea name="bio" rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                      placeholder="Tell us about yourself...">{{ auth()->user()->bio }}</textarea>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="toggleEdit('personalInfo')" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition">
                            Cancel
                        </button>
                        <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition font-medium">
                            Save Changes
                        </button>
                    </div>
                </form>

                <!-- Read-only View -->
                <div id="personalInfoView" class="space-y-3">
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Full Name</span>
                        <span class="font-medium text-right">
                            {{ auth()->user()->first_name }} 
                            {{ auth()->user()->middle_name ? auth()->user()->middle_name . ' ' : '' }}
                            {{ auth()->user()->last_name }}
                        </span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Email</span>
                        <span class="font-medium">{{ auth()->user()->email }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Phone</span>
                        <span class="font-medium">{{ auth()->user()->phone ?? 'Not set' }}</span>
                    </div>
                    @if(auth()->user()->bio)
                    <div class="py-2">
                        <span class="text-gray-600 block mb-1">Bio</span>
                        <p class="text-gray-800">{{ auth()->user()->bio }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Job Seeker Profile -->
            @if($currentRole === 'job_seeker')
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Job Seeker Profile</h3>
                    <button class="text-purple-600 hover:text-purple-700 text-sm font-medium" onclick="toggleEdit('jobSeekerProfile')">
                        Edit
                    </button>
                </div>
                
                <form id="jobSeekerProfileForm" action="{{ route('profile.update.job-seeker') }}" method="POST" class="hidden">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Professional Headline</label>
                            <input type="text" name="headline" value="{{ auth()->user()->jobSeekerProfile->headline ?? '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                   placeholder="e.g. Senior Web Developer">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Professional Summary</label>
                            <textarea name="summary" rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                      placeholder="Describe your experience, skills, and career goals...">{{ auth()->user()->jobSeekerProfile->summary ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" name="location" value="{{ auth()->user()->jobSeekerProfile->location ?? '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                   placeholder="City, Country">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                                <input type="url" name="website" value="{{ auth()->user()->jobSeekerProfile->website ?? '' }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
                                <input type="url" name="linkedin_url" value="{{ auth()->user()->jobSeekerProfile->linkedin_url ?? '' }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">GitHub URL</label>
                                <input type="url" name="github_url" value="{{ auth()->user()->jobSeekerProfile->github_url ?? '' }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Portfolio URL</label>
                                <input type="url" name="portfolio_url" value="{{ auth()->user()->jobSeekerProfile->portfolio_url ?? '' }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="toggleEdit('jobSeekerProfile')" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition">
                            Cancel
                        </button>
                        <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition font-medium">
                            Save Profile
                        </button>
                    </div>
                </form>

                <!-- Read-only View -->
                <div id="jobSeekerProfileView" class="space-y-3">
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Headline</span>
                        <span class="font-medium">{{ auth()->user()->jobSeekerProfile->headline ?? 'Not set' }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Location</span>
                        <span class="font-medium">{{ auth()->user()->jobSeekerProfile->location ?? 'Not set' }}</span>
                    </div>
                    @if(auth()->user()->jobSeekerProfile && auth()->user()->jobSeekerProfile->summary)
                    <div class="py-2">
                        <span class="text-gray-600 block mb-1">Summary</span>
                        <p class="text-gray-800">{{ auth()->user()->jobSeekerProfile->summary }}</p>
                    </div>
                    @endif
                    <div class="py-2">
                        <span class="text-gray-600 block mb-2">Social Links</span>
                        <div class="flex flex-wrap gap-3">
                            @if(auth()->user()->jobSeekerProfile && auth()->user()->jobSeekerProfile->website)
                            <a href="{{ auth()->user()->jobSeekerProfile->website }}" target="_blank" class="flex items-center space-x-1 text-purple-600 hover:text-purple-700">
                                <span>🌐</span>
                                <span>Website</span>
                            </a>
                            @endif
                            @if(auth()->user()->jobSeekerProfile && auth()->user()->jobSeekerProfile->linkedin_url)
                            <a href="{{ auth()->user()->jobSeekerProfile->linkedin_url }}" target="_blank" class="flex items-center space-x-1 text-blue-600 hover:text-blue-700">
                                <span>💼</span>
                                <span>LinkedIn</span>
                            </a>
                            @endif
                            @if(auth()->user()->jobSeekerProfile && auth()->user()->jobSeekerProfile->github_url)
                            <a href="{{ auth()->user()->jobSeekerProfile->github_url }}" target="_blank" class="flex items-center space-x-1 text-gray-600 hover:text-gray-700">
                                <span>⚡</span>
                                <span>GitHub</span>
                            </a>
                            @endif
                            @if(auth()->user()->jobSeekerProfile && auth()->user()->jobSeekerProfile->portfolio_url)
                            <a href="{{ auth()->user()->jobSeekerProfile->portfolio_url }}" target="_blank" class="flex items-center space-x-1 text-green-600 hover:text-green-700">
                                <span>🎨</span>
                                <span>Portfolio</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resume/CV Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Resume & CV</h3>
                
                @if(auth()->user()->jobSeekerProfile && auth()->user()->jobSeekerProfile->resume_path)
                <div class="flex items-center justify-between p-4 bg-purple-50 rounded-lg mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                            <span class="text-purple-600">📄</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ auth()->user()->jobSeekerProfile->resume_original_name ?? 'My_Resume.pdf' }}</p>
                            <p class="text-sm text-gray-600">Uploaded on {{ auth()->user()->jobSeekerProfile->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ Storage::url(auth()->user()->jobSeekerProfile->resume_path) }}" 
                           class="text-purple-600 hover:text-purple-700 font-medium" target="_blank">View</a>
                        <form action="{{ route('profile.resume.delete') }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 font-medium">Remove</button>
                        </form>
                    </div>
                </div>
                @else
                <div class="text-center py-8 border-2 border-dashed border-gray-300 rounded-lg">
                    <div class="text-4xl mb-2">📄</div>
                    <p class="text-gray-600 mb-2">No resume uploaded</p>
                    <p class="text-sm text-gray-500 mb-4">Upload your resume to apply for jobs faster</p>
                </div>
                @endif
                
                <form action="{{ route('profile.resume.upload') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <input type="file" name="resume" accept=".pdf,.doc,.docx" required
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition font-medium">
                            Upload Resume
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Supported formats: PDF, DOC, DOCX (Max: 5MB)</p>
                </form>
            </div>
            @endif

            <!-- Employer Profile -->
            @if($currentRole === 'employer')
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Company Information</h3>
                    <button class="text-purple-600 hover:text-purple-700 text-sm font-medium" onclick="toggleEdit('employerProfile')">
                        Edit
                    </button>
                </div>
                
                <form id="employerProfileForm" action="{{ route('profile.update.employer') }}" method="POST" class="hidden">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company Name *</label>
                            <input type="text" name="company_name" value="{{ auth()->user()->employerProfile->company_name ?? '' }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Company Email</label>
                                <input type="email" name="company_email" value="{{ auth()->user()->employerProfile->company_email ?? '' }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Company Phone</label>
                                <input type="tel" name="company_phone" value="{{ auth()->user()->employerProfile->company_phone ?? '' }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company Website</label>
                            <input type="url" name="company_website" value="{{ auth()->user()->employerProfile->company_website ?? '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company Description</label>
                            <textarea name="company_description" rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                      placeholder="Describe your company...">{{ auth()->user()->employerProfile->company_description ?? '' }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Company Size</label>
                                <select name="company_size" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                    <option value="">Select size</option>
                                    <option value="1-10" {{ (auth()->user()->employerProfile->company_size ?? '') == '1-10' ? 'selected' : '' }}>1-10 employees</option>
                                    <option value="11-50" {{ (auth()->user()->employerProfile->company_size ?? '') == '11-50' ? 'selected' : '' }}>11-50 employees</option>
                                    <option value="51-200" {{ (auth()->user()->employerProfile->company_size ?? '') == '51-200' ? 'selected' : '' }}>51-200 employees</option>
                                    <option value="201-500" {{ (auth()->user()->employerProfile->company_size ?? '') == '201-500' ? 'selected' : '' }}>201-500 employees</option>
                                    <option value="501-1000" {{ (auth()->user()->employerProfile->company_size ?? '') == '501-1000' ? 'selected' : '' }}>501-1000 employees</option>
                                    <option value="1000+" {{ (auth()->user()->employerProfile->company_size ?? '') == '1000+' ? 'selected' : '' }}>1000+ employees</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                                <input type="text" name="company_industry" value="{{ auth()->user()->employerProfile->company_industry ?? '' }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company Address</label>
                            <textarea name="company_address" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                      placeholder="Full company address...">{{ auth()->user()->employerProfile->company_address ?? '' }}</textarea>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="toggleEdit('employerProfile')" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition">
                            Cancel
                        </button>
                        <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition font-medium">
                            Save Company Info
                        </button>
                    </div>
                </form>

                <!-- Read-only View -->
                <div id="employerProfileView" class="space-y-3">
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Company Name</span>
                        <span class="font-medium">{{ auth()->user()->employerProfile->company_name ?? 'Not set' }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Company Email</span>
                        <span class="font-medium">{{ auth()->user()->employerProfile->company_email ?? 'Not set' }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Company Phone</span>
                        <span class="font-medium">{{ auth()->user()->employerProfile->company_phone ?? 'Not set' }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Company Website</span>
                        <span class="font-medium">{{ auth()->user()->employerProfile->company_website ?? 'Not set' }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Company Size</span>
                        <span class="font-medium">{{ auth()->user()->employerProfile->company_size ?? 'Not set' }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Industry</span>
                        <span class="font-medium">{{ auth()->user()->employerProfile->company_industry ?? 'Not set' }}</span>
                    </div>
                    @if(auth()->user()->employerProfile && auth()->user()->employerProfile->company_description)
                    <div class="py-2">
                        <span class="text-gray-600 block mb-1">Company Description</span>
                        <p class="text-gray-800">{{ auth()->user()->employerProfile->company_description }}</p>
                    </div>
                    @endif
                    @if(auth()->user()->employerProfile && auth()->user()->employerProfile->company_address)
                    <div class="py-2">
                        <span class="text-gray-600 block mb-1">Company Address</span>
                        <p class="text-gray-800">{{ auth()->user()->employerProfile->company_address }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Company Logo Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Company Logo</h3>
                
                @if(auth()->user()->employerProfile && auth()->user()->employerProfile->company_logo_path)
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                        <img src="{{ Storage::url(auth()->user()->employerProfile->company_logo_path) }}" 
                             alt="Company Logo" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Current Logo</p>
                        <p class="text-sm text-gray-600">Uploaded on {{ auth()->user()->employerProfile->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
                @else
                <div class="text-center py-8 border-2 border-dashed border-gray-300 rounded-lg mb-4">
                    <div class="text-4xl mb-2">🏢</div>
                    <p class="text-gray-600 mb-2">No company logo uploaded</p>
                    <p class="text-sm text-gray-500">Upload your company logo to build brand recognition</p>
                </div>
                @endif
                
                <form action="{{ route('profile.company-logo.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <input type="file" name="company_logo" accept="image/jpeg,image/png,image/jpg,image/gif" required
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition font-medium">
                            Upload Logo
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Supported formats: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
                </form>
            </div>
            @endif
        </div>

        <!-- Right Column - Role & Preferences -->
        <div class="space-y-6">
            <!-- Role Management -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Account Role</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">Current Mode</p>
                            <p class="text-sm text-gray-600" id="currentRoleDisplay">
                                {{ $currentRole === 'employer' ? 'Employer' : 'Job Seeker' }}
                            </p>
                        </div>
                        <div class="relative inline-block w-16 h-8 rounded-full bg-gray-300 cursor-pointer" id="roleToggle">
                            <input type="checkbox" class="sr-only" id="roleSwitch" 
                                   {{ $currentRole === 'employer' ? 'checked' : '' }}>
                            <div class="absolute left-1 top-1 w-6 h-6 rounded-full bg-white shadow-md transform transition-transform duration-200 ease-in-out" id="toggleCircle"></div>
                            <div class="absolute inset-0 flex items-center justify-between px-1 text-xs font-semibold">
                                <span class="text-purple-600">👤</span>
                                <span class="text-gray-600">🏢</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 bg-purple-50 rounded-lg">
                        <p class="text-sm text-purple-800">
                            @if($currentRole === 'employer')
                            <strong>Employer Mode:</strong> You can post jobs and manage applicants
                            @else
                            <strong>Job Seeker Mode:</strong> You can apply for jobs and manage applications
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Profile Completion -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Profile Completion</h3>
                
                @php
                    $completion = calculateProfileCompletion(auth()->user(), $currentRole);
                @endphp
                
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Overall Progress</span>
                            <span class="font-medium text-purple-600">{{ $completion['percentage'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $completion['percentage'] }}%"></div>
                        </div>
                    </div>
                    
                    <div class="space-y-2 text-sm">
                        @foreach($completion['items'] as $item)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">{{ $item['label'] }}</span>
                            <span class="{{ $item['completed'] ? 'text-green-500' : 'text-gray-400' }}">
                                {{ $item['completed'] ? '✓' : '○' }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('profile.settings') }}" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition w-full text-left">
                        <span>⚙️</span>
                        <span>Account Settings</span>
                    </a>
                    <a href="{{ route('profile.notifications') }}" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition w-full text-left">
                        <span>🔔</span>
                        <span>Notifications</span>
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition w-full text-left">
                            <span>🚪</span>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Role toggle functionality
    const roleToggle = document.getElementById('roleToggle');
    const roleSwitch = document.getElementById('roleSwitch');
    const toggleCircle = document.getElementById('toggleCircle');
    const currentRoleDisplay = document.getElementById('currentRoleDisplay');

    roleToggle.addEventListener('click', function() {
        roleSwitch.checked = !roleSwitch.checked;
        updateRoleToggle();
        
        // Make AJAX request to update role
        fetch('{{ route("dashboard.role.toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                is_employer: roleSwitch.checked
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const newRole = roleSwitch.checked ? 'Employer' : 'Job Seeker';
                currentRoleDisplay.textContent = newRole;
                showNotification('Role updated successfully!', 'success');
                
                // Reload after a short delay to update navigation
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error updating role', 'error');
            // Revert the toggle
            roleSwitch.checked = !roleSwitch.checked;
            updateRoleToggle();
        });
    });

    function updateRoleToggle() {
        if (roleSwitch.checked) {
            toggleCircle.style.transform = 'translateX(32px)';
            roleToggle.classList.remove('bg-gray-300');
            roleToggle.classList.add('bg-purple-300');
        } else {
            toggleCircle.style.transform = 'translateX(0)';
            roleToggle.classList.remove('bg-purple-300');
            roleToggle.classList.add('bg-gray-300');
        }
    }

    // Edit toggle functionality
    function toggleEdit(section) {
        const form = document.getElementById(section + 'Form');
        const view = document.getElementById(section + 'View');
        
        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
            view.classList.add('hidden');
        } else {
            form.classList.add('hidden');
            view.classList.remove('hidden');
        }
    }

    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
            type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
        }`;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Initialize role toggle
    updateRoleToggle();
</script>
@endsection

<?php
// Helper function for profile completion (add this to a helper file or at the bottom of the view)
function calculateProfileCompletion($user, $currentRole) {
    $items = [
        'basic_info' => ['label' => 'Basic Information', 'completed' => !empty($user->first_name) && !empty($user->last_name)],
        'email' => ['label' => 'Email Address', 'completed' => !empty($user->email)],
        'phone' => ['label' => 'Phone Number', 'completed' => !empty($user->phone)],
    ];

    if ($currentRole === 'employer') {
        $items['company_name'] = ['label' => 'Company Name', 'completed' => $user->employerProfile && !empty($user->employerProfile->company_name)];
        $items['company_info'] = ['label' => 'Company Info', 'completed' => $user->employerProfile && !empty($user->employerProfile->company_description)];
        $items['company_logo'] = ['label' => 'Company Logo', 'completed' => $user->employerProfile && !empty($user->employerProfile->company_logo_path)];
    } else {
        $items['job_seeker_profile'] = ['label' => 'Job Seeker Profile', 'completed' => $user->jobSeekerProfile && !empty($user->jobSeekerProfile->headline)];
        $items['resume'] = ['label' => 'Resume', 'completed' => $user->jobSeekerProfile && !empty($user->jobSeekerProfile->resume_path)];
        $items['location'] = ['label' => 'Location', 'completed' => $user->jobSeekerProfile && !empty($user->jobSeekerProfile->location)];
    }

    $completed = collect($items)->filter(fn($item) => $item['completed'])->count();
    $total = count($items);
    $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;

    return [
        'items' => $items,
        'completed' => $completed,
        'total' => $total,
        'percentage' => $percentage,
    ];
}
?>