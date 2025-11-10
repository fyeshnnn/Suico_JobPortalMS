<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\Category;
use App\Models\JobApplication;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Check current role from session
        $currentRole = session('current_role', 'job_seeker');
        
        if ($currentRole === 'employer' && $user->is_employer) {
            return $this->employerDashboard();
        }
        
        // Default to job seeker
        return $this->jobSeekerDashboard();
    }

    private function jobSeekerDashboard()
    {
        $user = auth()->user();
        
        // Get featured jobs for recommendations
        $recommendedJobs = JobListing::with(['employer.employerProfile', 'category'])
            ->featured()
            ->where('is_active', true)
            ->where('application_deadline', '>=', now())
            ->take(4)
            ->get();

        // Get recent applications
        $recentApplications = JobApplication::where('user_id', $user->id)
            ->with(['job.employer.employerProfile', 'job.category'])
            ->latest()
            ->take(5)
            ->get();

        // Get categories for filter
        $categories = Category::where('is_active', true)->get();

        // Get job types for filter
        $jobTypes = [
            'full_time' => 'Full Time',
            'part_time' => 'Part Time', 
            'contract' => 'Contract',
            'freelance' => 'Freelance',
            'internship' => 'Internship'
        ];

        return view('dashboard.index', compact(
            'user',
            'recommendedJobs', 
            'recentApplications',
            'categories',
            'jobTypes'
        ));
    }

    private function employerDashboard()
    {
        $user = auth()->user();
        
        // Get employer's jobs with applicant counts
        $postedJobs = JobListing::where('employer_id', $user->id)
            ->withCount('applications')
            ->latest()
            ->get();

        // Get recent applicants across all jobs
        $recentApplicants = JobApplication::whereHas('job', function($query) use ($user) {
                $query->where('employer_id', $user->id);
            })
            ->with(['user.jobSeekerProfile', 'job'])
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'total_jobs' => $postedJobs->count(),
            'active_jobs' => $postedJobs->where('is_active', true)->count(),
            'total_applicants' => $postedJobs->sum('applications_count'),
            'new_applicants' => $recentApplicants->where('created_at', '>=', now()->subDays(7))->count()
        ];

        return view('dashboard.employer', compact(
            'user',
            'postedJobs',
            'recentApplicants',
            'stats'
        ));
    }

    public function toggleRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:job_seeker,employer'
        ]);

        $user = auth()->user();

        if ($request->role === 'employer' && !$user->is_employer) {
            return response()->json(['success' => false, 'message' => 'You are not registered as an employer.'], 403);
        }

        session(['current_role' => $request->role]);

        return response()->json(['success' => true]);
    }
}