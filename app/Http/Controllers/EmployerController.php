<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\Category;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function jobs()
    {
        $jobs = JobListing::where('employer_id', auth()->id())
            ->withCount('applications')
            ->latest()
            ->get();

        return view('employer.jobs', compact('jobs'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $jobTypes = [
            'full_time' => 'Full Time',
            'part_time' => 'Part Time', 
            'contract' => 'Contract',
            'freelance' => 'Freelance',
            'internship' => 'Internship'
        ];

        return view('employer.create-job', compact('categories', 'jobTypes'));
    }

    public function show(JobListing $job)
    {
        // Ensure the job belongs to the current user
        if ($job->employer_id !== auth()->id()) {
            abort(403);
        }

        $applications = $job->applications()->with(['user.jobSeekerProfile'])->get();

        return view('employer.job-details', compact('job', 'applications'));
    }

    public function applicants(JobListing $job)
    {
        // Ensure the job belongs to the current user
        if ($job->employer_id !== auth()->id()) {
            abort(403);
        }

        $applications = $job->applications()
            ->with(['user.jobSeekerProfile'])
            ->latest()
            ->get();

        return view('employer.applicants', compact('job', 'applications'));
    }
}