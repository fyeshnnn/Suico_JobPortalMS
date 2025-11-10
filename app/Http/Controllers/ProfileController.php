<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\JobSeekerProfile;
use App\Models\EmployerProfile;

class ProfileController extends Controller
{
    // User Profile Page - Edit personal info
    public function show()
    {
        $user = auth()->user();
        $currentRole = session('current_role', 'job_seeker');
        
        return view('profile.show', compact('user', 'currentRole'));
    }

    // Update User Profile
    public function update(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    // Update Job Seeker Profile
    public function updateJobSeekerProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'headline' => 'nullable|string|max:255',
            'summary' => 'nullable|string|max:2000',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
        ]);

        // Create or update job seeker profile
        if ($user->jobSeekerProfile) {
            $user->jobSeekerProfile->update($validated);
        } else {
            $user->jobSeekerProfile()->create($validated);
        }

        return back()->with('success', 'Job seeker profile updated successfully!');
    }

    // Upload Resume
    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
        ]);

        $user = auth()->user();
        
        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            if ($user->jobSeekerProfile && $user->jobSeekerProfile->resume_path) {
                Storage::delete($user->jobSeekerProfile->resume_path);
            }

            $path = $request->file('resume')->store('resumes', 'public');
            
            if (!$user->jobSeekerProfile) {
                $user->jobSeekerProfile()->create([
                    'resume_path' => $path,
                    'resume_original_name' => $request->file('resume')->getClientOriginalName(),
                ]);
            } else {
                $user->jobSeekerProfile->update([
                    'resume_path' => $path,
                    'resume_original_name' => $request->file('resume')->getClientOriginalName(),
                ]);
            }
        }

        return back()->with('success', 'Resume uploaded successfully!');
    }

    // Delete Resume
    public function deleteResume()
    {
        $user = auth()->user();
        
        if ($user->jobSeekerProfile && $user->jobSeekerProfile->resume_path) {
            Storage::delete($user->jobSeekerProfile->resume_path);
            $user->jobSeekerProfile->update([
                'resume_path' => null,
                'resume_original_name' => null,
            ]);
        }

        return back()->with('success', 'Resume deleted successfully!');
    }

    // Update Employer Profile
    public function updateEmployerProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'nullable|email|max:255',
            'company_phone' => 'nullable|string|max:20',
            'company_website' => 'nullable|url|max:255',
            'company_description' => 'nullable|string|max:2000',
            'company_size' => 'nullable|string|max:50',
            'company_industry' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:500',
        ]);

        // Create or update employer profile
        if ($user->employerProfile) {
            $user->employerProfile->update($validated);
        } else {
            $user->employerProfile()->create($validated);
        }

        return back()->with('success', 'Employer profile updated successfully!');
    }

    // Upload Company Logo
    public function uploadCompanyLogo(Request $request)
    {
        $request->validate([
            'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        $user = auth()->user();
        
        if ($request->hasFile('company_logo')) {
            // Delete old logo if exists
            if ($user->employerProfile && $user->employerProfile->company_logo_path) {
                Storage::delete($user->employerProfile->company_logo_path);
            }

            $path = $request->file('company_logo')->store('company-logos', 'public');
            
            if (!$user->employerProfile) {
                $user->employerProfile()->create([
                    'company_logo_path' => $path,
                ]);
            } else {
                $user->employerProfile->update([
                    'company_logo_path' => $path,
                ]);
            }
        }

        return back()->with('success', 'Company logo uploaded successfully!');
    }

    // Settings Page
    public function settings()
    {
        $user = auth()->user();
        return view('profile.settings', compact('user'));
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    // Update Notification Preferences
    public function updateNotifications(Request $request)
    {
        $user = auth()->user();
        
        $user->update([
            'notification_preferences' => [
                'email_job_alerts' => $request->has('email_job_alerts'),
                'email_application_updates' => $request->has('email_application_updates'),
                'email_newsletter' => $request->has('email_newsletter'),
                'push_notifications' => $request->has('push_notifications'),
            ]
        ]);

        return back()->with('success', 'Notification preferences updated successfully!');
    }

    // Notifications / Messages Page
    public function notifications()
    {
        $user = auth()->user();
        
        // Sample notifications (in real app, these would come from database)
        $notifications = [
            [
                'id' => 1,
                'type' => 'application_update',
                'title' => 'Application Status Updated',
                'message' => 'Your application for Senior Laravel Developer has been reviewed.',
                'time' => now()->subMinutes(30),
                'read' => false,
                'action_url' => '#'
            ],
            [
                'id' => 2,
                'type' => 'job_alert',
                'title' => 'New Job Match',
                'message' => 'A new Laravel Developer position matches your profile.',
                'time' => now()->subHours(2),
                'read' => true,
                'action_url' => '#'
            ],
            [
                'id' => 3,
                'type' => 'message',
                'title' => 'New Message from TechCorp',
                'message' => 'We would like to schedule an interview for your application.',
                'time' => now()->subDays(1),
                'read' => false,
                'action_url' => '#'
            ],
        ];

        return view('profile.notifications', compact('user', 'notifications'));
    }

    // Mark notification as read
    public function markNotificationRead($id)
    {
        // In real app, update notification status in database
        return back()->with('success', 'Notification marked as read.');
    }

    // Clear all notifications
    public function clearNotifications()
    {
        // In real app, clear user's notifications
        return back()->with('success', 'All notifications cleared.');
    }
}