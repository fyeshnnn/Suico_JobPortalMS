@extends('layouts.dashboard')

@section('title', 'Employer Dashboard - SeiyaSphere')

@section('content')
<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Total Jobs</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_jobs'] }}</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <span class="text-purple-600 text-xl">💼</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Active Jobs</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['active_jobs'] }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <span class="text-green-600 text-xl">✅</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Total Applicants</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_applicants'] }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <span class="text-blue-600 text-xl">👥</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">New Applicants</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['new_applicants'] }}</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <span class="text-yellow-600 text-xl">🆕</span>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Posted Jobs -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Your Posted Jobs</h2>
            <a href="{{ route('employer.jobs.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition font-semibold">
                Post New Job
            </a>
        </div>

        <div class="space-y-4">
            @foreach($postedJobs as $job)
            <div class="border border-gray-200 rounded-lg p-4 hover:border-purple-300 hover:shadow-md transition">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 text-lg">{{ $job->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $job->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-3 py-1 text-xs rounded-full 
                            {{ $job->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $job->is_active ? 'Active' : 'Closed' }}
                        </span>
                        <p class="text-sm text-gray-600 mt-1">{{ $job->applications_count }} applicants</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
                    <span>📍 {{ $job->location }}</span>
                    <span>💰 {{ $job->salary_range }}</span>
                    <span>📅 {{ $job->application_deadline->diffForHumans() }}</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-xs text-purple-600 bg-purple-50 px-2 py-1 rounded">{{ $job->category->name ?? 'Uncategorized' }}</span>
                    <div class="flex space-x-3">
                        <a href="{{ route('employer.jobs.show', $job) }}" class="text-purple-600 hover:text-purple-700 text-sm font-semibold">
                            View Details
                        </a>
                        <a href="{{ route('employer.jobs.applicants', $job) }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                            View Applicants ({{ $job->applications_count }})
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            @if($postedJobs->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-500 mb-4">You haven't posted any jobs yet.</p>
                <a href="{{ route('employer.jobs.create') }}" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition font-semibold">
                    Post Your First Job
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Recent Applicants -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Recent Applicants</h2>

        <div class="space-y-4">
            @foreach($recentApplicants as $application)
            <div class="border border-gray-200 rounded-lg p-4 hover:border-purple-300 hover:shadow-md transition">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                        <span class="text-purple-600 font-semibold text-sm">
                            {{ strtoupper(substr($application->user->first_name, 0, 1)) }}
                        </span>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800">{{ $application->user->full_name }}</h4>
                        <p class="text-sm text-gray-600">{{ $application->job->title }}</p>
                    </div>
                    <span class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-xs text-purple-600 bg-purple-50 px-2 py-1 rounded">
                        {{ $application->user->jobSeekerProfile->headline ?? 'No headline' }}
                    </span>
                    <div class="flex space-x-2">
                        <span class="inline-block px-2 py-1 text-xs rounded-full 
                            {{ $application->status === 'accepted' ? 'bg-green-100 text-green-800' : 
                               ($application->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach

            @if($recentApplicants->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-500">No recent applicants.</p>
            </div>
            @endif
        </div>
        
        @if(!$recentApplicants->isEmpty())
        <div class="mt-6 text-center">
            <a href="#" class="text-purple-600 hover:text-purple-700 font-semibold">
                View All Applicants →
            </a>
        </div>
        @endif
    </div>
</div>
@endsection