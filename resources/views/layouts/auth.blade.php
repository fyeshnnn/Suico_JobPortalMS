<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SeiyaSphere')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white rounded-2xl shadow-xl p-8">
        <!-- Logo -->
        <div class="text-center">
            <div class="flex items-center justify-center space-x-1 mb-4">
                    <img src="{{ Storage::url('images/logo.png') }}" alt="SeiyaSphere Logo" class="w-14 h-14">
                <span class="text-2xl font-bold text-purple-700">SeiyaSphere</span>
            </div>
            <p class="text-purple-500 text-sm">Where opportunities orbit you!</p>
        </div>

        <!-- Content -->
        @yield('content')
    </div>
</body>
</html>