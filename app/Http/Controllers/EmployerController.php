<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\JobApplication;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployerController extends Controller
{
    // Posted Jobs Page - List of jobs user has created
    public function jobs()
    {
        $jobs = JobListing::where('employer_id', auth()->id())
            ->withCount('applications')
            ->with('category')
            ->latest()
            ->get();

        return view('employer.jobs.index', compact('jobs'));
    }

    // Post a Job Page - Form for creating new listing
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

        $experienceLevels = [
            'entry' => 'Entry Level',
            'mid' => 'Mid Level',
            'senior' => 'Senior Level',
            'executive' => 'Executive'
        ];

        return view('employer.jobs.create', compact('categories', 'jobTypes', 'experienceLevels'));
    }

    // Store new job posting
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'job_type' => 'required|in:full_time,part_time,contract,freelance,internship',
            'experience_level' => 'required|in:entry,mid,senior,executive',
            'location' => 'required|string|max:255',
            'is_remote' => 'boolean',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'application_deadline' => 'required|date|after:today',
            'vacancies' => 'required|integer|min:1',
        ]);

        $validated['employer_id'] = auth()->id();
        $validated['is_remote'] = $request->has('is_remote');
        $validated['salary_currency'] = 'PHP';

        JobListing::create($validated);

        return redirect()->route('employer.jobs')->with('success', 'Job posted successfully!');
    }

    // Job Post Details Page - View full posting details
    public function show(JobListing $job)
    {
        // Ensure the job belongs to the current user
        if ($job->employer_id !== auth()->id()) {
            abort(403);
        }

        $applications = $job->applications()
            ->with(['user.jobSeekerProfile'])
            ->latest()
            ->get();

        return view('employer.jobs.show', compact('job', 'applications'));
    }

    // Applicant Review Page - View and manage applications
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

        return view('employer.jobs.applicants', compact('job', 'applications'));
    }

    // Update application status (Accept, Reject)
    public function updateApplication(Request $request, JobApplication $application)
    {
        // Ensure the application belongs to the employer's job
        if ($application->job->employer_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected,pending'
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Application status updated successfully!');
    }
}