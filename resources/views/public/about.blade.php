@extends('layouts.app')

@section('title', 'About Us - SeiyaSphere')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <!-- Hero Section -->
    <div class="text-center mb-16">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">About SeiyaSphere</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Revolutionizing the way talent meets opportunity through intelligent matching and seamless connectivity.
        </p>
    </div>

    <!-- Mission & Vision -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
        <div class="bg-purple-50 p-8 rounded-2xl">
            <h2 class="text-2xl font-bold text-purple-700 mb-4">Our Mission</h2>
            <p class="text-gray-700 mb-4">
                To create a Connected Job Environment that effectively links candidates and companies, 
                focusing on relevance and efficiency through our innovative "orbit" matching system.
            </p>
            <p class="text-gray-700">
                We believe that finding the right opportunity shouldn't feel like searching for a needle in a haystack. 
                With SeiyaSphere, opportunities find you.
            </p>
        </div>
        
        <div class="bg-purple-50 p-8 rounded-2xl">
            <h2 class="text-2xl font-bold text-purple-700 mb-4">Our Vision</h2>
            <p class="text-gray-700 mb-4">
                To become the global, all-encompassing platform where every job and every candidate exist 
                within a single, visible ecosystem.
            </p>
            <p class="text-gray-700">
                A world where career growth is accessible, intuitive, and driven by intelligent connections 
                rather than endless applications.
            </p>
        </div>
    </div>

    <!-- How It Works -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">How SeiyaSphere Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">👤</span>
                </div>
                <h3 class="text-xl font-semibold mb-3">Create Profile</h3>
                <p class="text-gray-600">Sign up and create your comprehensive profile with skills, experience, and preferences.</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🔄</span>
                </div>
                <h3 class="text-xl font-semibold mb-3">Orbit Matching</h3>
                <p class="text-gray-600">Our algorithm continuously matches you with relevant opportunities based on your profile.</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">💼</span>
                </div>
                <h3 class="text-xl font-semibold mb-3">Get Opportunities</h3>
                <p class="text-gray-600">Receive proactive alerts and connect with perfect matches without endless searching.</p>
            </div>
        </div>
    </div>

    <!-- Team Values -->
    <div class="bg-purple-600 text-white rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-center mb-8">Our Values</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center">
                <h3 class="text-xl font-semibold mb-3">Innovation</h3>
                <p class="text-purple-100">Constantly evolving our matching algorithms and platform features.</p>
            </div>
            <div class="text-center">
                <h3 class="text-xl font-semibold mb-3">Transparency</h3>
                <p class="text-purple-100">Clear communication and honest relationships with all users.</p>
            </div>
            <div class="text-center">
                <h3 class="text-xl font-semibold mb-3">Inclusion</h3>
                <p class="text-purple-100">Creating equal opportunities for all job seekers and employers.</p>
            </div>
            <div class="text-center">
                <h3 class="text-xl font-semibold mb-3">Efficiency</h3>
                <p class="text-purple-100">Saving time and resources for both candidates and companies.</p>
            </div>
        </div>
    </div>
</div>
@endsection