@extends('layouts.app')

@section('title', 'Terms & Conditions - SeiyaSphere')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Terms & Conditions</h1>
        <p class="text-gray-600">Last updated: {{ date('F d, Y') }}</p>
    </div>

    <div class="prose prose-purple max-w-none">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">1. Acceptance of Terms</h2>
                <p class="text-gray-700 mb-4">
                    By accessing and using SeiyaSphere ("the Platform"), you accept and agree to be bound by the terms and provision of this agreement.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">2. User Accounts</h2>
                <p class="text-gray-700 mb-4">
                    Users may register for an account and can maintain multiple roles (Job Seeker and Employer) under a single account. You are responsible for maintaining the confidentiality of your account and password.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">3. User Responsibilities</h2>
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-800">Job Seekers:</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>Provide accurate and complete information in your profile</li>
                        <li>Maintain the confidentiality of your account credentials</li>
                        <li>Use the platform for legitimate job seeking purposes only</li>
                    </ul>

                    <h3 class="text-xl font-semibold text-gray-800">Employers:</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>Post legitimate job opportunities</li>
                        <li>Respond to applications in a timely manner</li>
                        <li>Maintain accurate company information</li>
                    </ul>
                </div>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">4. Privacy Policy</h2>
                <p class="text-gray-700 mb-4">
                    Your privacy is important to us. We collect and use personal information solely for the purpose of providing and improving our services. We do not share your information with third parties without your consent.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">5. Intellectual Property</h2>
                <p class="text-gray-700 mb-4">
                    All content on this platform, including text, graphics, logos, and software, is the property of SeiyaSphere and is protected by intellectual property laws.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">6. Limitation of Liability</h2>
                <p class="text-gray-700 mb-4">
                    SeiyaSphere shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of or inability to use the service.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">7. Changes to Terms</h2>
                <p class="text-gray-700 mb-4">
                    We reserve the right to modify these terms at any time. We will notify users of any changes by posting the new terms on this page.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">8. Contact Information</h2>
                <p class="text-gray-700">
                    If you have any questions about these Terms, please contact us at:
                    <br>
                    <strong>Email:</strong> legal@seiyasphere.com
                    <br>
                    <strong>Address:</strong> 123 Tech Park Avenue, San Francisco, CA 94107
                </p>
            </section>
        </div>
    </div>
</div>
@endsection