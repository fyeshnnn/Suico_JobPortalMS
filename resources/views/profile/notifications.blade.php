<!-- resources/views/profile/notifications.blade.php -->
@extends('layouts.app')

@section('title', 'Notifications - SeiyaSphere')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Notifications</h1>
        <p class="text-gray-600">Stay updated with your job applications and messages</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Notifications Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-gray-800">Filters</h3>
                    <form action="{{ route('profile.notifications.clear') }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                            Clear all
                        </button>
                    </form>
                </div>
                
                <nav class="space-y-2">
                    <button class="flex items-center justify-between w-full p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition filter-btn active" data-filter="all">
                        <span class="flex items-center space-x-3">
                            <span>📬</span>
                            <span>All Notifications</span>
                        </span>
                        <span class="bg-purple-100 text-purple-600 text-xs rounded-full w-6 h-6 flex items-center justify-center">{{ auth()->user()->unreadNotifications()->count() }}</span>
                    </button>
                    <button class="flex items-center justify-between w-full p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition filter-btn" data-filter="messages">
                        <span class="flex items-center space-x-3">
                            <span>💬</span>
                            <span>Messages</span>
                        </span>
                        <span class="bg-blue-100 text-blue-600 text-xs rounded-full w-6 h-6 flex items-center justify-center">3</span>
                    </button>
                    <button class="flex items-center justify-between w-full p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition filter-btn" data-filter="applications">
                        <span class="flex items-center space-x-3">
                            <span>📝</span>
                            <span>Applications</span>
                        </span>
                        <span class="bg-green-100 text-green-600 text-xs rounded-full w-6 h-6 flex items-center justify-center">5</span>
                    </button>
                    <button class="flex items-center justify-between w-full p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition filter-btn" data-filter="jobs">
                        <span class="flex items-center space-x-3">
                            <span>💼</span>
                            <span>Job Alerts</span>
                        </span>
                        <span class="bg-yellow-100 text-yellow-600 text-xs rounded-full w-6 h-6 flex items-center justify-center">4</span>
                    </button>
                </nav>
            </div>
        </div>

        <!-- Notifications Content -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <!-- Notifications Header -->
                <div class="p-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="font-semibold text-gray-800" id="notificationsTitle">All Notifications</h3>
                    <div class="flex items-center space-x-2">
                        <select class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option>Sort by: Newest</option>
                            <option>Sort by: Oldest</option>
                        </select>
                    </div>
                </div>

                <!-- Notifications List -->
                <div class="divide-y divide-gray-200 max-h-[600px] overflow-y-auto">
                    @forelse(auth()->user()->notifications as $notification)
                    <div class="p-4 hover:bg-gray-50 transition notification-item {{ $notification->read_at ? '' : 'bg-blue-50' }}" 
                         data-type="{{ $notification->data['type'] ?? 'system' }}">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 
                                {{ $notification->data['type'] == 'message' ? 'bg-blue-100 text-blue-600' : 
                                   ($notification->data['type'] == 'application' ? 'bg-green-100 text-green-600' : 
                                   ($notification->data['type'] == 'job_alert' ? 'bg-yellow-100 text-yellow-600' : 'bg-gray-100 text-gray-600')) }}">
                                @if($notification->data['type'] == 'message')
                                💬
                                @elseif($notification->data['type'] == 'application')
                                📝
                                @elseif($notification->data['type'] == 'job_alert')
                                💼
                                @else
                                ⚙️
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $notification->data['title'] ?? 'Notification' }}
                                    </p>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                        @if(!$notification->read_at)
                                        <form action="{{ route('profile.notifications.read', $notification->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-xs text-blue-600 hover:text-blue-700">Mark read</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">
                                    {{ $notification->data['message'] ?? $notification->data['body'] ?? '' }}
                                </p>
                                @if(isset($notification->data['action_url']))
                                <div class="flex items-center space-x-2">
                                    <a href="{{ $notification->data['action_url'] }}" class="text-sm text-purple-600 hover:text-purple-700 font-medium">
                                        View Details
                                    </a>
                                </div>
                                @endif
                            </div>
                            @if(!$notification->read_at)
                            <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0 mt-2"></div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center">
                        <div class="text-4xl mb-4">📭</div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No notifications</h3>
                        <p class="text-gray-500">You're all caught up! New notifications will appear here.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Filter notifications
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active button
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            const notifications = document.querySelectorAll('.notification-item');
            let visibleCount = 0;
            
            // Update title
            const titles = {
                'all': 'All Notifications',
                'messages': 'Messages',
                'applications': 'Application Updates',
                'jobs': 'Job Alerts'
            };
            document.getElementById('notificationsTitle').textContent = titles[filter];
            
            // Filter items
            notifications.forEach(item => {
                if (filter === 'all' || item.dataset.type === filter) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>

<style>
.filter-btn.active {
    background-color: #f3f4f6;
    color: #8b5cf6;
    font-weight: 600;
}
</style>
@endsection