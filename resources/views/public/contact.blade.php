@extends('layouts.app')

@section('title', 'Contact Us - SeiyaSphere')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-16">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Contact Us</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Have questions? We're here to help. Get in touch with our team.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Contact Information -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Get In Touch</h2>
            
            <div class="space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <span class="text-purple-600">📧</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Email</h3>
                        <p class="text-gray-600">support@seiyasphere.com</p>
                        <p class="text-gray-600">info@seiyasphere.com</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <span class="text-purple-600">📞</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Phone</h3>
                        <p class="text-gray-600">+1 (555) 123-4567</p>
                        <p class="text-gray-600">Mon-Fri: 9:00 AM - 6:00 PM</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <span class="text-purple-600">📍</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Address</h3>
                        <p class="text-gray-600">123 Tech Park Avenue</p>
                        <p class="text-gray-600">San Francisco, CA 94107</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <span class="text-purple-600">💬</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Live Chat</h3>
                        <p class="text-gray-600">Available 24/7 for immediate assistance</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Send us a Message</h2>
            <form action="#" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>
                </div>
                
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                    <input type="text" id="subject" name="subject" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea id="message" name="message" rows="5" required 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"></textarea>
                </div>

                <button type="submit" 
                        class="w-full bg-purple-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-purple-700 transition focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection