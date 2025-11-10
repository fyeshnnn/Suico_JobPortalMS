@extends('layouts.dashboard')

@section('title', 'Job Seeker Dashboard - SeiyaSphere')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-2xl p-8 text-white mb-8">
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold mb-3">Explore a galaxy of opportunities, tailored for you</h1>
        <p class="text-purple-100 text-lg">Discover opportunities in your orbit</p>
    </div>

    <!-- Search Box -->
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg p-2 shadow-lg">
            <div class="flex">
                <input type="text" 
                       placeholder="Job title, keywords, or company..." 
                       class="flex-1 px-4 py-3 text-gray-800 rounded-l-lg focus:outline-none">
                <button class="bg-purple-600 text-white px-8 py-3 rounded-r-lg hover:bg-purple-700 transition font-semibold">
                    Search
                </button>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Left Side - Filters -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Filter Jobs</h3>
            
            <!-- Keywords -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Keywords</label>
                <input type="text" placeholder="e.g., Laravel, Remote" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
            </div>

            <!-- Location -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                <input type="text" placeholder="City, state, or remote" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Job Type -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Job Type</label>
                <div class="space-y-2">
                    @foreach($jobTypes as $key => $type)
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded text-purple-600 focus:ring-purple-500">
                        <span class="ml-2 text-sm text-gray-700">{{ $type }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Salary Range -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Salary Range (₱)</label>
                <div class="flex items-center space-x-3">
                    <input type="number" name="min_salary" placeholder="Min" 
                           class="w-1/2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <span class="text-gray-500">—</span>
                    <input type="number" name="max_salary" placeholder="Max" 
                           class="w-1/2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
            </div>

            <button class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition font-semibold">
                Apply Filters
            </button>
        </div>
    </div>

    <!-- Right Side - Personalized Overview -->
    <div class="lg:col-span-3">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-blue-600 text-xl">📁</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">5</p>
                        <p class="text-sm text-gray-600">Applications</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-green-600 text-xl">⭐</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">12</p>
                        <p class="text-sm text-gray-600">Saved Jobs</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-purple-600 text-xl">👁️</span>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">3</p>
                        <p class="text-sm text-gray-600">Profile Views</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommended Jobs -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Recommended For You</h2>
                <a href="#" class="text-purple-600 hover:text-purple-700 font-semibold">View All</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($recommendedJobs as $job)
                <div class="border border-gray-200 rounded-lg p-4 hover:border-purple-300 hover:shadow-md transition group">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition">
                                <span class="text-purple-600 font-bold text-sm">
                                    {{ substr($job->employer->employerProfile->company_name ?? 'CO', 0, 2) }}
                                </span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 group-hover:text-purple-600 transition">{{ $job->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $job->employer->employerProfile->company_name ?? 'Company' }}</p>
                            </div>
                        </div>
                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Featured</span>
                    </div>
                    
                    <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
                        <span>📍 {{ $job->location }}</span>
                        <span>💰 {{ $job->salary_range }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-purple-600 bg-purple-50 px-2 py-1 rounded">{{ $job->category->name }}</span>
                        <button class="text-purple-600 hover:text-purple-700 text-sm font-semibold">Apply Now</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Applications -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Recent Applications</h2>
                <a href="#" class="text-purple-600 hover:text-purple-700 font-semibold">View All</a>
            </div>
            
            <div class="space-y-4">
                @foreach($recentApplications as $application)
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-purple-300 hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <span class="text-purple-600 font-bold text-sm">
                                {{ substr($application->job->employer->employerProfile->company_name ?? 'CO', 0, 2) }}
                            </span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $application->job->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $application->job->employer->employerProfile->company_name ?? 'Company' }}</p>
                            <div class="flex items-center space-x-4 text-sm text-gray-500 mt-1">
                                <span>📍 {{ $application->job->location }}</span>
                                <span>📅 Applied {{ $application->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <span class="inline-block px-2 py-1 text-xs rounded-full 
                            {{ $application->status === 'accepted' ? 'bg-green-100 text-green-800' : 
                               ($application->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                </div>
                @endforeach

                @if($recentApplications->isEmpty())
                <div class="text-center py-8">
                    <p class="text-gray-500 mb-4">You haven't applied to any jobs yet.</p>
                    <a href="#" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition font-semibold">
                        Browse Jobs
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection