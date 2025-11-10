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
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.png') }}" alt="SeiyaSphere Logo" class="h-8 w-8">
                        <span class="text-xl font-bold text-purple-600">SeiyaSphere</span>
                    </a>
                </div>

                <!-- Header Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-purple-600 font-medium">Home</a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium">Jobs</a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium">Companies</a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium">Career Tips</a>
                </nav>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <button class="relative p-2 text-gray-600 hover:text-purple-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM10.5 3.75a6 6 0 00-6 6v2.25l-2.47 2.47a.75.75 0 00.53 1.28h15.88a.75.75 0 00.53-1.28L16.5 12V9.75a6 6 0 00-6-6z"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    </button>

                    <!-- User Avatar with Role Toggle -->
                    <div class="flex items-center space-x-3">
                        <!-- Role Toggle -->
                        <div class="hidden sm:flex items-center space-x-2 bg-gray-100 rounded-full px-3 py-1">
                            <span class="text-xs text-gray-600">View as:</span>
                            <div class="relative inline-block w-12 h-6 rounded-full bg-gray-300 cursor-pointer" id="roleToggle">
                                <input type="checkbox" class="sr-only" id="roleSwitch" {{ session('current_role', 'job_seeker') === 'employer' ? 'checked' : '' }}>
                                <div class="absolute left-1 top-1 w-4 h-4 rounded-full bg-white shadow-md transform transition-transform duration-200 ease-in-out" id="toggleCircle"></div>
                                <div class="absolute inset-0 flex items-center justify-between px-1 text-xs">
                                    <span class="text-purple-600">👤</span>
                                    <span class="text-gray-600">🏢</span>
                                </div>
                            </div>
                        </div>

                        <!-- User Avatar -->
                        <button id="userMenuButton" class="flex items-center space-x-2 text-sm focus:outline-none">
                            <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                            </div>
                            <span class="hidden sm:block text-gray-700 font-medium">{{ auth()->user()->first_name }}</span>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <!-- Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 sidebar-overlay z-40 hidden"></div>

    <!-- Right Sidebar - User Menu -->
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
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-2xl flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-semibold text-gray-800 truncate">{{ auth()->user()->full_name }}</h4>
                    <p class="text-sm text-purple-600 mt-1" id="sidebarRole">
                        {{ session('current_role', 'job_seeker') === 'employer' ? 'Employer' : 'Job Seeker' }}
                    </p>
                    <div class="mt-2">
                        <span class="inline-block bg-purple-100 text-purple-600 text-xs px-2 py-1 rounded-full" id="profileStatus">
                            @if(session('current_role', 'job_seeker') === 'employer')
                                Company Profile: {{ auth()->user()->employerProfile ? 'Complete' : 'Incomplete' }}
                            @else
                                Profile: {{ auth()->user()->jobSeekerProfile ? 'Complete' : 'Incomplete' }}
                            @endif
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
                
                @if(session('current_role', 'job_seeker') === 'employer')
                    <!-- Employer Navigation -->
                    <a href="{{ route('profile.show') }}" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        <span>👤</span>
                        <span>My Profile</span>
                    </a>
                    <a href="{{ route('employer.jobs.create') }}" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        <span>➕</span>
                        <span>Post a Job</span>
                    </a>
                    <a href="{{ route('employer.jobs') }}" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        <span>📋</span>
                        <span>My Job Posts</span>
                    </a>
                @else
                    <!-- Job Seeker Navigation -->
                    <a href="{{ route('profile.show') }}" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        <span>👤</span>
                        <span>My Profile</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        <span>📝</span>
                        <span>My Applications</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        <span>⭐</span>
                        <span>Saved Jobs</span>
                    </a>
                @endif
                
                <a href="{{ route('profile.notifications') }}" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                    <span>🔔</span>
                    <span>Notifications</span>
                    <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                </a>
                <a href="{{ route('profile.settings') }}" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
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

    <!-- JavaScript -->
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

        // Initialize role toggle position based on current session
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

        roleToggle.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent triggering the sidebar open
            roleSwitch.checked = !roleSwitch.checked;
            updateRoleToggle();
            toggleRole();
        });

        function toggleRole() {
            const newRole = roleSwitch.checked ? 'employer' : 'job_seeker';
            
            fetch('{{ route("dashboard.role.toggle") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ role: newRole })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the sidebar role display immediately
                    const sidebarRole = document.getElementById('sidebarRole');
                    if (sidebarRole) {
                        sidebarRole.textContent = newRole === 'employer' ? 'Employer' : 'Job Seeker';
                    }
                    
                    // Update profile status based on role
                    const profileStatus = document.getElementById('profileStatus');
                    if (profileStatus) {
                        if (newRole === 'employer') {
                            profileStatus.textContent = 'Company Profile: Incomplete';
                            profileStatus.className = 'inline-block bg-orange-100 text-orange-600 text-xs px-2 py-1 rounded-full';
                        } else {
                            profileStatus.textContent = 'Profile: Incomplete';
                            profileStatus.className = 'inline-block bg-purple-100 text-purple-600 text-xs px-2 py-1 rounded-full';
                        }
                    }
                    
                    // Close sidebar and reload page to show correct navigation
                    closeSidebarFunc();
                    setTimeout(() => {
                        window.location.reload();
                    }, 300);
                }
            })
            .catch(error => {
                console.error('Error switching role:', error);
                // Revert the toggle on error
                roleSwitch.checked = !roleSwitch.checked;
                updateRoleToggle();
                alert('Error switching roles. Please try again.');
            });
        }

        // Initialize the role toggle on page load
        updateRoleToggle();
    </script>
</body>
</html>