<!-- resources/views/profile/settings.blade.php -->
@extends('layouts.app')

@section('title', 'Settings - SeiyaSphere')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Account Settings</h1>
        <p class="text-gray-600">Manage your account preferences and security</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Settings Navigation -->
        <div class="lg:col-span-1">
            <nav class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 space-y-2">
                <a href="#password" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg settings-nav-link active">
                    <span>🔒</span>
                    <span>Password</span>
                </a>
                <a href="#notifications" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg settings-nav-link">
                    <span>🔔</span>
                    <span>Notifications</span>
                </a>
                <a href="#privacy" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg settings-nav-link">
                    <span>👁️</span>
                    <span>Privacy</span>
                </a>
            </nav>
        </div>

        <!-- Settings Content -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Password Settings -->
            <div id="password" class="settings-section active">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Change Password</h3>
                    
                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                <input type="password" name="current_password" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                @error('current_password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <input type="password" name="new_password" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                @error('new_password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition font-medium">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Notification Settings -->
            <div id="notifications" class="settings-section hidden">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Notification Preferences</h3>
                    
                    <form action="{{ route('profile.notifications.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <!-- Email Notifications -->
                            <div>
                                <h4 class="font-medium text-gray-800 mb-4">Email Notifications</h4>
                                <div class="space-y-3">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="email_job_alerts" value="1" 
                                               {{ old('email_job_alerts', auth()->user()->notification_preferences['email_job_alerts'] ?? true) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                                        <span class="ml-3 text-gray-700">Job alerts and recommendations</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="email_application_updates" value="1"
                                               {{ old('email_application_updates', auth()->user()->notification_preferences['email_application_updates'] ?? true) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                                        <span class="ml-3 text-gray-700">Application status updates</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="email_employer_messages" value="1"
                                               {{ old('email_employer_messages', auth()->user()->notification_preferences['email_employer_messages'] ?? true) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                                        <span class="ml-3 text-gray-700">Messages from employers</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Push Notifications -->
                            <div>
                                <h4 class="font-medium text-gray-800 mb-4">Push Notifications</h4>
                                <div class="space-y-3">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="push_new_messages" value="1"
                                               {{ old('push_new_messages', auth()->user()->notification_preferences['push_new_messages'] ?? true) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                                        <span class="ml-3 text-gray-700">New messages</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="push_application_updates" value="1"
                                               {{ old('push_application_updates', auth()->user()->notification_preferences['push_application_updates'] ?? true) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                                        <span class="ml-3 text-gray-700">Application updates</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition font-medium">
                                Save Preferences
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Privacy Settings -->
            <div id="privacy" class="settings-section hidden">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Privacy Settings</h3>
                    
                    <form action="{{ route('profile.privacy.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <!-- Profile Visibility -->
                            <div>
                                <h4 class="font-medium text-gray-800 mb-4">Profile Visibility</h4>
                                <div class="space-y-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="profile_visibility" value="public"
                                               {{ old('profile_visibility', auth()->user()->privacy_settings['profile_visibility'] ?? 'public') === 'public' ? 'checked' : '' }}
                                               class="text-purple-600 focus:ring-purple-500">
                                        <span class="ml-3 text-gray-700">
                                            <strong>Public</strong> - Anyone can see my profile
                                        </span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="profile_visibility" value="employers"
                                               {{ old('profile_visibility', auth()->user()->privacy_settings['profile_visibility'] ?? 'public') === 'employers' ? 'checked' : '' }}
                                               class="text-purple-600 focus:ring-purple-500">
                                        <span class="ml-3 text-gray-700">
                                            <strong>Employers Only</strong> - Only verified employers can see my profile
                                        </span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="profile_visibility" value="private"
                                               {{ old('profile_visibility', auth()->user()->privacy_settings['profile_visibility'] ?? 'public') === 'private' ? 'checked' : '' }}
                                               class="text-purple-600 focus:ring-purple-500">
                                        <span class="ml-3 text-gray-700">
                                            <strong>Private</strong> - Only I can see my profile
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Resume Visibility -->
                            <div>
                                <h4 class="font-medium text-gray-800 mb-4">Resume Visibility</h4>
                                <div class="space-y-3">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="resume_searchable" value="1"
                                               {{ old('resume_searchable', auth()->user()->privacy_settings['resume_searchable'] ?? true) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                                        <span class="ml-3 text-gray-700">
                                            Make my resume searchable by employers
                                        </span>
                                    </label>
                                    <p class="text-sm text-gray-600 ml-7">
                                        When enabled, employers can find and contact you about job opportunities
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition font-medium">
                                Save Privacy Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Settings navigation
    document.querySelectorAll('.settings-nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all links and sections
            document.querySelectorAll('.settings-nav-link').forEach(l => l.classList.remove('active'));
            document.querySelectorAll('.settings-section').forEach(s => s.classList.add('hidden'));
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Show corresponding section
            const targetId = this.getAttribute('href').substring(1);
            document.getElementById(targetId).classList.remove('hidden');
        });
    });
</script>

<style>
.settings-nav-link.active {
    background-color: #f3f4f6;
    color: #8b5cf6;
    font-weight: 600;
}
</style>
@endsection