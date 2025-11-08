@extends('layouts.app')

@section('title', 'Privacy Policy - SeiyaSphere')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Privacy Policy</h1>
        <p class="text-gray-600">Last updated: {{ date('F d, Y') }}</p>
    </div>

    <div class="prose prose-purple max-w-none">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">1. Information We Collect</h2>
                <p class="text-gray-700 mb-4">
                    We collect information you provide directly to us when you:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                    <li>Create an account as a job seeker or employer</li>
                    <li>Complete your profile information</li>
                    <li>Apply for jobs or post job listings</li>
                    <li>Contact our support team</li>
                    <li>Subscribe to our newsletters</li>
                </ul>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">2. How We Use Your Information</h2>
                <p class="text-gray-700 mb-4">
                    We use the information we collect to:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                    <li>Provide, maintain, and improve our services</li>
                    <li>Process your job applications and connect you with employers</li>
                    <li>Send you job recommendations and career opportunities</li>
                    <li>Communicate with you about updates and new features</li>
                    <li>Ensure the security and integrity of our platform</li>
                </ul>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">3. Information Sharing</h2>
                <p class="text-gray-700 mb-4">
                    We do not sell your personal information. We may share your information with:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                    <li>Employers when you apply for their job postings</li>
                    <li>Job seekers when they view your company's job postings</li>
                    <li>Service providers who assist in operating our platform</li>
                    <li>Legal authorities when required by law</li>
                </ul>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">4. Data Security</h2>
                <p class="text-gray-700 mb-4">
                    We implement appropriate security measures to protect your personal information from unauthorized access, alteration, or destruction. However, no method of transmission over the Internet is 100% secure.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">5. Your Rights</h2>
                <p class="text-gray-700 mb-4">
                    You have the right to:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                    <li>Access and update your personal information</li>
                    <li>Delete your account and personal data</li>
                    <li>Opt-out of marketing communications</li>
                    <li>Export your data from our platform</li>
                </ul>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">6. Cookies and Tracking</h2>
                <p class="text-gray-700 mb-4">
                    We use cookies and similar tracking technologies to enhance your experience on our platform, analyze usage patterns, and deliver personalized content.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">7. Changes to This Policy</h2>
                <p class="text-gray-700 mb-4">
                    We may update this privacy policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last updated" date.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">8. Contact Us</h2>
                <p class="text-gray-700">
                    If you have any questions about this Privacy Policy, please contact us at:
                    <br>
                    <strong>Email:</strong> privacy@seiyasphere.com
                    <br>
                    <strong>Address:</strong> 123 Tech Park Avenue, San Francisco, CA 94107
                </p>
            </section>
        </div>
    </div>
</div>
@endsection