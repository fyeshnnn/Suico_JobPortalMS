<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PublicController extends Controller
{
    public function landing()
    {
        $popularCategories = collect();
        $featuredJobs = collect();
        $latestJobs = collect();

        if (class_exists('App\Models\Category')) {
            try {
                $popularCategories = \App\Models\Category::withCount('jobListings')
                    ->where('is_active', true)
                    ->orderBy('job_count', 'desc')
                    ->take(8)
                    ->get();
            } catch (\Exception $e) {
                $popularCategories = collect();
            }
        }

        if (class_exists('App\Models\JobListing')) {
            try {
                $featuredJobs = \App\Models\JobListing::with(['employer.employerProfile', 'category'])
                    ->featured()
                    ->take(6)
                    ->get();

                $latestJobs = \App\Models\JobListing::with(['employer.employerProfile', 'category'])
                    ->latest()
                    ->take(8)
                    ->get();
            } catch (\Exception $e) {
                $featuredJobs = collect();
                $latestJobs = collect();
            }
        }

        $jobsCount = 0;
        $companiesCount = 0;
        $candidatesCount = 0;

        try {
            if (class_exists('App\Models\JobListing')) {
                $jobsCount = \App\Models\JobListing::active()->count();
            }
            $companiesCount = User::where('is_employer', true)->count();
            $candidatesCount = User::where('is_job_seeker', true)->count();
        } catch (\Exception $e) {
        }

        $stats = [
            'jobs_posted' => $jobsCount > 0 ? $jobsCount : 1250,
            'companies' => $companiesCount > 0 ? $companiesCount : 150,
            'candidates' => $candidatesCount > 0 ? $candidatesCount : 3500,
            'success_rate' => '85%'
        ];

        return view('public.landing', compact(
            'stats', 
            'popularCategories', 
            'featuredJobs', 
            'latestJobs'
        ));
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function faq()
    {
        $faqs = [
            [
                'question' => 'How do I create an account?',
                'answer' => 'Click on the Register button and fill in your details including first name, last name, email, and password. You can choose to be both a job seeker and employer with the same account.'
            ],
            [
                'question' => 'Who can post jobs on SeiyaSphere?',
                'answer' => 'Both job seekers and employers can post opportunities. Job seekers may share freelance projects or collaborations, while employers can post open positions.'
            ],
            [
                'question' => 'Do job posts need admin approval?',
                'answer' => 'Yes, to maintain quality and trust, all job postings go through an admin review before they are published. This ensures that listings are accurate, safe, and compliant with our guidelines.'
            ],
            [
                'question' => 'How do I apply for a job?',
                'answer' => 'Once a job is posted and approved, you can view the listing and click Apply. You’ll be prompted to submit your profile or resume directly through the platform.'
            ],
            [
                'question' => 'How does the orbit matching system work?',
                'answer' => 'Our intelligent algorithm analyzes your profile, skills, and preferences to match you with relevant job opportunities. The system proactively notifies you when suitable matches are found.'
            ],
            [
                'question' => 'Is Seiyasphere free to use?',
                'answer' => 'Job seekers can access core features at no cost. Employers have the option to unlock premium tools for advanced hiring needs. For more details, see our Pricing page.'
            ],
            [
                'question' => 'How do I reset my password?',
                'answer' => 'Click on "Forgot your password?" on the login page and enter your email address. We\'ll send you a link to reset your password.'
            ],
            [
                'question' => 'Can I delete my account?',
                'answer' => 'Yes, you can delete your account from the settings page. Please note that this action is permanent and cannot be undone.'
            ],
        ];

        return view('public.faq', compact('faqs'));
    }

    public function terms()
    {
        return view('public.terms');
    }
    public function privacy()
    {
        return view('public.privacy');
    }
}