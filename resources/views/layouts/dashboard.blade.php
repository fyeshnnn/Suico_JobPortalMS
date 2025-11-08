<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - SeiyaSphere')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary-purple: #8B5CF6;
            --light-purple: #C4B5FD;
            --soft-purple: #EDE9FE;
            --dark-purple: #7C3AED;
        }
        .sidebar-transition {
            transition: all 0.3s ease-in-out;
        }
        .sidebar-overlay {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-xl font-bold text-purple-600">SeiyaSphere</h1>
                </div>

                <!-- Header Navigation -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <div class="relative">
                        <button class="text-gray-600 hover:text-purple-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM10.5 3.75a6 6 0 00-6 6v2.25l-2.47 2.47a.75.75 0 00.53 1.28h15.88a.75.75 0 00.53-1.28L16.5 12V9.75a6 6 0 00-6-6z"/>
                            </svg>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </button>
                    </div>

                    <!-- User Profile Button -->
                    <button id="userMenuButton" class="flex items-center space-x-3 text-sm focus:outline-none p-2 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                            </div>
                            <div class="hidden md:block text-left">
                                <div class="font-medium text-gray-800">{{ auth()->user()->first_name }}</div>
                                <div class="text-xs text-gray-500 flex items-center space-x-2">
                                    <span id="currentRole">{{ auth()->user()->is_employer ? 'Employer' : 'Job Seeker' }}</span>
                                    <!-- Role Toggle -->
                                    <div class="relative inline-block w-12 h-6 rounded-full bg-gray-300 cursor-pointer" id="roleToggle">
                                        <input type="checkbox" class="sr-only" id="roleSwitch" {{ auth()->user()->is_employer ? 'checked' : '' }}>
                                        <div class="absolute left-1 top-1 w-4 h-4 rounded-full bg-white shadow-md transform transition-transform duration-200 ease-in-out" id="toggleCircle"></div>
                                        <div class="absolute inset-0 flex items-center justify-between px-1 text-xs">
                                            <span class="text-purple-600">👤</span>
                                            <span class="text-gray-600">🏢</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto flex">

        <!-- Main Content Area -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>

    <!-- Sidebar Overlay (hidden by default) -->
    <div id="sidebarOverlay" class="fixed inset-0 sidebar-overlay z-40 hidden"></div>

    <!-- Right Sidebar - Account Menu (hidden by default) -->
    <div id="sidebar" class="fixed top-0 right-0 h-full w-80 bg-white shadow-2xl z-50 sidebar-transition transform translate-x-full">
        <!-- Sidebar Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">My Account</h3>
                <button id="closeSidebar" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- User Profile -->
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-800">{{ auth()->user()->full_name }}</h4>
                    <p class="text-sm text-purple-600">{{ auth()->user()->primary_role }}</p>
                    <div class="mt-1">
                        <span class="inline-block bg-purple-100 text-purple-600 text-xs px-2 py-1 rounded-full">
                            Profile: {{ auth()->user()->hasJobSeekerProfile() ? 'Complete' : 'Incomplete' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="p-6">
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 bg-purple-100 text-purple-600 rounded-lg font-semibold">
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>
                
                @if(session('current_role', auth()->user()->is_employer ? 'employer' : 'job_seeker') === 'employer')
                    <!-- Employer Navigation -->
                    <a href="{{ route('employer.jobs') }}" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        <span>💼</span>
                        <span>My Job Posts</span>
                    </a>
                    <a href="{{ route('employer.jobs.create') }}" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        <span>➕</span>
                        <span>Post a Job</span>
                    </a>
                @else
                    <!-- Job Seeker Navigation -->
                    <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        <span>👤</span>
                        <span>My Profile</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        <span>💼</span>
                        <span>My Applications</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        <span>⭐</span>
                        <span>Saved Jobs</span>
                    </a>
                @endif
                
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                    <span>🔔</span>
                    <span>Notifications</span>
                    <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                    <span>⚙️</span>
                    <span>Settings</span>
                </a>
            </nav>

            <!-- Logout Section -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition w-full text-left">
                        <span>🚪</span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

  <!-- JavaScript for Sidebar and Role Toggle -->
<script>
    // Sidebar functionality
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const userMenuButton = document.getElementById('userMenuButton');
    const closeSidebar = document.getElementById('closeSidebar');

    // Open sidebar
    userMenuButton.addEventListener('click', function(e) {
        // Don't open sidebar if clicking the role toggle
        if (e.target.closest('#roleToggle')) {
            return;
        }
        sidebar.classList.remove('translate-x-full');
        sidebarOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    // Close sidebar
    function closeSidebarFunc() {
        sidebar.classList.add('translate-x-full');
        sidebarOverlay.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    closeSidebar.addEventListener('click', closeSidebarFunc);
    sidebarOverlay.addEventListener('click', closeSidebarFunc);

    // Close sidebar with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSidebarFunc();
        }
    });

    // Role toggle functionality
    const roleToggle = document.getElementById('roleToggle');
    const roleSwitch = document.getElementById('roleSwitch');
    const toggleCircle = document.getElementById('toggleCircle');
    const currentRole = document.getElementById('currentRole');

    // Initialize role toggle
    updateRoleToggle();

    roleToggle.addEventListener('click', function(e) {
        e.stopPropagation(); // Prevent triggering the sidebar open
        e.preventDefault(); // Prevent any default behavior
        
        roleSwitch.checked = !roleSwitch.checked;
        updateRoleToggle();
        toggleRole();
    });

    function updateRoleToggle() {
        if (roleSwitch.checked) {
            toggleCircle.style.transform = 'translateX(24px)';
            roleToggle.classList.remove('bg-gray-300');
            roleToggle.classList.add('bg-purple-300');
        } else {
            toggleCircle.style.transform = 'translateX(0)';
            roleToggle.classList.remove('bg-purple-300');
            roleToggle.classList.add('bg-gray-300');
        }
    }

    function toggleRole() {
        const newRole = roleSwitch.checked ? 'employer' : 'job_seeker';
        
        console.log('Switching to role:', newRole);
        
        // Show loading state
        const originalText = currentRole.textContent;
        currentRole.innerHTML = '<span class="animate-pulse">Switching...</span>';
        
        // Make AJAX request to update role
        fetch('{{ route("dashboard.role.toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                role: newRole
            })
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.success) {
                // Reload the page to reflect the new role
                window.location.reload();
            } else {
                throw new Error(data.message || 'Failed to switch role');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            currentRole.textContent = originalText;
            // Revert the toggle
            roleSwitch.checked = !roleSwitch.checked;
            updateRoleToggle();
            alert('Error switching role: ' + error.message);
        });
    }
</script>