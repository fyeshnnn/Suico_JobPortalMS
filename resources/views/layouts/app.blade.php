<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SeiyaSphere')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary-purple: #8B5CF6;
            --light-purple: #C4B5FD;
            --soft-purple: #EDE9FE;
            --dark-purple: #7C3AED;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-1">
                    <img src="{{ Storage::url('images/logo.png') }}" alt="SeiyaSphere Logo" class="w-14 h-14">
    <span class="text-xl font-bold text-purple-700">SeiyaSphere</span>
</div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-600 transition">Home</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-purple-600 transition">About</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-purple-600 transition">Contact</a>
                    <a href="{{ route('faq') }}" class="text-gray-700 hover:text-purple-600 transition">FAQ</a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-purple-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">SeiyaSphere</h3>
                    <p class="text-purple-200">Where opportunities orbit you. Connecting talent with opportunities globally.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-purple-200 hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-purple-200 hover:text-white transition">About</a></li>
                        <li><a href="{{ route('contact') }}" class="text-purple-200 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('terms') }}" class="text-purple-200 hover:text-white transition">Terms & Conditions</a></li>
                        <li><a href="#" class="text-purple-200 hover:text-white transition">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact Info</h4>
                    <p class="text-purple-200">Email: info@seiyasphere.com</p>
                    <p class="text-purple-200">Phone: +1 (555) 123-4567</p>
                </div>
            </div>
            <div class="border-t border-purple-700 mt-8 pt-8 text-center text-purple-200">
                <p>&copy; 2025 SeiyaSphere. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>