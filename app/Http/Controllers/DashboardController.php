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
        $currentRole = session('current_role', $user->is_employer ? 'employer' : 'job_seeker');
        
        if ($currentRole === 'employer' && $user->is_employer) {
            // Load employer dashboard
            return $this->employerDashboard();
        }
        
        // Load job seeker dashboard
        return $this->jobSeekerDashboard();
    }

    private function jobSeekerDashboard()
    {
        $user = auth()->user();
        
        // Get featured jobs for recommendations
        $recommendedJobs = JobListing::with(['employer.employerProfile', 'category'])
            ->featured()
            ->take(4)
            ->get();

        // Get latest jobs
        $latestJobs = JobListing::with(['employer.employerProfile', 'category'])
            ->latest()
            ->take(6)
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
            'latestJobs',
            'categories',
            'jobTypes'
        ));
    }

    private function employerDashboard()
    {
        $user = auth()->user();
        
        // Get employer's jobs
        $postedJobs = JobListing::where('employer_id', $user->id)
            ->withCount('applications')
            ->latest()
            ->get();

        // Get recent applicants
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
    try {
        $user = auth()->user();
        $role = $request->input('role');

        \Log::info('Role toggle attempt', [
            'user_id' => $user->id,
            'user_email' => $user->email,
            'requested_role' => $role,
            'is_employer' => $user->is_employer,
            'is_job_seeker' => $user->is_job_seeker
        ]);

        // For testing, allow role switching even if user doesn't have employer permissions
        // In production, you might want to be more strict
        if ($role === 'employer') {
            // Allow switching to employer mode if user has employer permissions OR for testing
            if ($user->is_employer) {
                session(['current_role' => 'employer']);
                \Log::info('Switched to employer role (user has permissions)');
            } else {
                // For testing/demo purposes, allow switching anyway
                session(['current_role' => 'employer']);
                \Log::info('Switched to employer role (demo mode - no permissions)');
            }
            return response()->json(['success' => true, 'message' => 'Switched to employer mode']);
            
        } elseif ($role === 'job_seeker') {
            session(['current_role' => 'job_seeker']);
            \Log::info('Switched to job seeker role');
            return response()->json(['success' => true, 'message' => 'Switched to job seeker mode']);
        }

        return response()->json([
            'success' => false, 
            'message' => 'Invalid role specified'
        ]);
        
    } catch (\Exception $e) {
        \Log::error('Role toggle error: ' . $e->getMessage());
        return response()->json([
            'success' => false, 
            'message' => 'Server error: ' . $e->getMessage()
        ]);
        }
    }
}