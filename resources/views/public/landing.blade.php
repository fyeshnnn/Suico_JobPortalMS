@extends('layouts.app')

@section('title', 'SeiyaSphere')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-purple-600 to-purple-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">Your next career opportunity is orbitting closer!</h1>
        <p class="text-xl mb-8 text-purple-100">No more scrolling through the void—discover opportunities that truly align.</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('register') }}" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-purple-100 transition">Get Started</a>
            <a href="{{ route('about') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition">Learn More</a>
        </div>
    </div>
</section>

<!-- Popular Categories Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Popular Categories</h2>
            <p class="text-gray-600 mt-4">Browse jobs by popular categories</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($popularCategories as $category)
            <div class="bg-purple-50 rounded-lg p-6 text-center hover:bg-purple-100 transition cursor-pointer group">
                <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-700 transition">
                    <span class="text-white text-xl">💼</span>
                </div>
                <h3 class="font-semibold text-gray-800">{{ $category->name }}</h3>
                <p class="text-sm text-purple-600 mt-1">{{ $category->job_count }} jobs</p>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-8">
            <a href="#" class="text-purple-600 hover:text-purple-700 font-semibold">
                View All Categories →
            </a>
        </div>
    </div>
</section>

<!-- Featured Jobs Section -->
<section class="py-16 bg-purple-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Featured Jobs</h2>
            <p class="text-gray-600 mt-4">Hand-picked opportunities from top companies</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredJobs as $job)
            <div class="bg-white rounded-xl shadow-lg border border-purple-200 p-6 hover:shadow-xl transition">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <span class="text-purple-600 font-bold text-sm">
                                {{ substr($job->employer->employerProfile->company_name ?? 'CO', 0, 2) }}
                            </span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $job->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $job->employer->employerProfile->company_name ?? 'Company' }}</p>
                        </div>
                    </div>
                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Featured</span>
                </div>
                
                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-sm text-gray-600">
                        <span class="mr-2">📍</span>
                        {{ $job->location }}{{ $job->is_remote ? ' • Remote' : '' }}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <span class="mr-2">💼</span>
                        {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <span class="mr-2">💰</span>
                        {{ $job->salary_range }}
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-xs text-purple-600 bg-purple-50 px-2 py-1 rounded">
                        {{ $job->category->name }}
                    </span>
                    <span class="text-xs text-gray-500">
                        {{ $job->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        
        @if($featuredJobs->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500">No featured jobs available at the moment.</p>
        </div>
        @endif
    </div>
</section>

<!-- Latest Jobs Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Latest Jobs</h2>
            <p class="text-gray-600 mt-4">Newest opportunities on our platform</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($latestJobs as $job)
            <div class="bg-white rounded-lg border border-gray-200 p-6 hover:border-purple-300 hover:shadow-md transition group">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-4">
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
                    @if($job->is_new)
                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">New</span>
                    @endif
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="flex items-center text-sm text-gray-600">
                        <span class="mr-2">📍</span>
                        {{ $job->location }}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <span class="mr-2">💼</span>
                        {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <span class="mr-2">⭐</span>
                        {{ ucfirst($job->experience_level) }}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <span class="mr-2">💰</span>
                        {{ $job->salary_range }}
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-xs text-purple-600 bg-purple-50 px-2 py-1 rounded">
                        {{ $job->category->name }}
                    </span>
                    <span class="text-xs text-gray-500">
                        {{ $job->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        
        @if($latestJobs->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500">No jobs available at the moment.</p>
        </div>
        @else
        <div class="text-center mt-8">
            <a href="#" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition">
                View All Jobs
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-3xl font-bold text-purple-600 mb-2">{{ $stats['jobs_posted'] }}+</div>
                <div class="text-gray-600">Jobs Posted</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-purple-600 mb-2">{{ $stats['companies'] }}+</div>
                <div class="text-gray-600">Companies</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-purple-600 mb-2">{{ $stats['candidates'] }}+</div>
                <div class="text-gray-600">Candidates</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-purple-600 mb-2">{{ $stats['success_rate'] }}</div>
                <div class="text-gray-600">Success Rate</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-purple-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Why Choose SeiyaSphere?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🌐</span>
                </div>
                <h3 class="text-xl font-semibold mb-3">Smart Matching</h3>
                <p class="text-gray-600">Our orbit algorithm brings relevant jobs directly to you based on your profile and preferences.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">⚡</span>
                </div>
                <h3 class="text-xl font-semibold mb-3">Dual Roles</h3>
                <p class="text-gray-600">Be both a job seeker and employer with the same account. Flexibility at its best.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🔔</span>
                </div>
                <h3 class="text-xl font-semibold mb-3">Proactive Alerts</h3>
                <p class="text-gray-600">Get notified when matching opportunities appear. No more manual searching.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">What Our Users Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-purple-50 p-6 rounded-lg">
                <p class="text-gray-600 mb-4">"SeiyaSphere found me the perfect job match within days! The orbit system really works."</p>
                <div class="font-semibold text-purple-600">- Sarah Johnson</div>
            </div>
            <div class="bg-purple-50 p-6 rounded-lg">
                <p class="text-gray-600 mb-4">"As both an employer and job seeker, this platform is incredibly flexible and powerful."</p>
                <div class="font-semibold text-purple-600">- Michael Chen</div>
            </div>
            <div class="bg-purple-50 p-6 rounded-lg">
                <p class="text-gray-600 mb-4">"The proactive job alerts saved me hours of searching. Opportunities really do come to you!"</p>
                <div class="font-semibold text-purple-600">- Emily Rodriguez</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-purple-600 text-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to take your career beyond the ordinary?</h2>
        <p class="text-xl mb-8 text-purple-100">Discover a universe of opportunities waiting in SeiyaSphere.</p>
        <a href="{{ route('register') }}" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-purple-100 transition">Create Your Account Now</a>
    </div>
</section>
@endsection