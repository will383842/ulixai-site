@extends('admin.dashboard.index')

@section('title', 'Mission Conversation')

@section('admin-content')
@php 
    $reports = $conversation->reports ?? [];
@endphp
<div class="min-h-screen bg-gray-50 py-8">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Mission Conversation</h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Managing conversation for: 
                        <span class="font-medium text-blue-600">{{ $mission->title ?? 'Untitled Mission' }}</span>
                    </p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                        {{ $conversation ? $conversation->messages->count() : 0 }} Messages
                    </div>
                    @if($conversation && $conversation->messages->count() > 0)
                        <div class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                            {{ $conversation->messages->groupBy('sender_id')->count() }} Participants
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if($conversation && $conversation->messages->count())
            <!-- Users Control Panel -->
            @php
                $users = $conversation->messages->groupBy('sender_id')->map(function($messages) {
                    return $messages->first()->sender;
                })->filter(function($user) {
                    return !($user->is_admin ?? false);
                });
            @endphp
            
            @if($users->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">User Management</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($users as $user)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                        {{ Str::upper(Str::substr($user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-900">{{ $user->name ?? 'Unknown User' }}</h4>
                                        <p class="text-xs text-gray-500">{{ $user->email ?? 'No email' }}</p>
                                    </div>
                                    <span class="user-status-badge" data-user-id="{{ $user->id }}">
                                        @if($user->status === 'suspended' ?? false)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Blocked
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <div class="w-2 h-2 bg-green-400 rounded-full mr-1"></div>
                                                Active
                                            </span>
                                        @endif
                                    </span>
                                </div>
                                
                                <!-- User Action Button -->
                                <div class="user-action-btn" data-user-id="{{ $user->id }}">
                                    @if($user->status === 'suspended' ?? false)
                                        <button onclick="toggleUserStatus({{ $user->id }}, 'unblock')"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-700 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 hover:border-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-150">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="btn-text">Unblock User</span>
                                        </button>
                                    @else
                                        <button onclick="toggleUserStatus({{ $user->id }}, 'block')"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-150">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                                            </svg>
                                            <span class="btn-text">Block User</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <!-- Conversation Container -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6">
                <!-- Conversation Header -->
                <div class="px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">Conversation History</h2>
                        <div class="flex items-center space-x-4">
                            <!-- Conversation Actions -->
                            <button onclick="scrollToTop()" class="text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                </svg>
                                Top
                            </button>
                            <button onclick="scrollToBottom()" class="text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                </svg>
                                Bottom
                            </button>
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $conversation->updated_at->format('M d, Y at g:i A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div id="messagesContainer" class="divide-y divide-gray-50 max-h-96 overflow-y-auto">
                    @foreach($conversation->messages as $message)
                        <div class="px-6 py-5 hover:bg-gray-25 transition-colors duration-150 message-item" 
                             data-message-id="{{ $message->id }}" data-user-id="{{ $message->sender->id ?? 0 }}">
                            <div class="flex items-start space-x-4">
                                <!-- Avatar -->
                                <div class="flex-shrink-0">
                                    @if($message->sender->is_admin ?? false)
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                            {{ Str::upper(Str::substr($message->sender->name ?? 'U', 0, 1)) }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Message Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h4 class="text-sm font-semibold text-gray-900">
                                            {{ $message->sender->name ?? 'Unknown User' }}
                                        </h4>
                                        
                                        @if($message->sender->is_admin ?? false)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                                                </svg>
                                                Admin
                                            </span>
                                        @else
                                            <!-- User Status Badge -->
                                            <span class="user-status-badge" data-user-id="{{ $message->sender->id ?? 0 }}">
                                                @if($message->sender->status === 'suspended' ?? false)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 715.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Blocked
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <div class="w-2 h-2 bg-green-400 rounded-full mr-1"></div>
                                                        Active
                                                    </span>
                                                @endif
                                            </span>
                                        @endif

                                        <span class="text-xs text-gray-500">
                                            {{ $message->created_at->format('M d, g:i A') }}
                                        </span>
                                        
                                        <!-- Time difference indicator -->
                                        @if(!$loop->first)
                                            @php
                                                $prevMessage = $conversation->messages[$loop->index - 1];
                                                $timeDiff = $message->created_at->diffInMinutes($prevMessage->created_at);
                                            @endphp
                                            @if($timeDiff > 60)
                                                <span class="text-xs text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">
                                                    {{ $timeDiff > 1440 ? round($timeDiff/1440) . 'd later' : round($timeDiff/60) . 'h later' }}
                                                </span>
                                            @endif
                                        @endif
                                    </div>
                                    
                                    <div class="prose prose-sm max-w-none">
                                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $message->body }}</p>
                                    </div>

                                    <!-- Message Actions -->
                                    <div class="mt-3 flex items-center space-x-4 text-xs text-gray-500">
                                        <button onclick="highlightMessage({{ $message->id }})" 
                                                class="hover:text-blue-600 transition-colors flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                            </svg>
                                            Highlight
                                        </button>
                                        <span class="text-gray-300">|</span>
                                        <span>Message ID: #{{ $message->id }}</span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Conversation Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 rounded-b-xl">
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>{{ $conversation->messages->count() }} messages in this conversation</span>
                        <div class="flex items-center space-x-4">
                            <button onclick="refreshConversation()" class="text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Refresh
                            </button>
                            <span>Last updated {{ $conversation->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Reports Section -->
            @if($conversation && $reports->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">Conversation Reports</h2>
                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $reports->count() }} Reports
                        </span>
                    </div>

                    <div class="space-y-4">
                        @foreach($reports as $report)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="font-medium text-gray-900">Reported by:</span>
                                            <span class="text-sm text-gray-600">
                                                @if($report->reported_by === $conversation->requester_id)
                                                    Requester ({{ $conversation->requester->name ?? 'Unknown' }})
                                                @elseif($report->reported_by === optional($conversation->provider->user)->id)
                                                    Provider ({{ $conversation->provider->first_name ?? 'Unknown' }})
                                                @else
                                                    Unknown User
                                                @endif
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-700 mb-2">{{ $report->reason }}</p>
                                        <div class="text-xs text-gray-500">
                                            Reported {{ $report->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if($report->reported_by === $conversation->requester_id)
                                            <!-- Block Provider Button -->
                                            <button onclick="toggleUserStatus({{ optional($conversation->provider->user)->id }}, '{{ optional($conversation->provider->user)->status === 'suspended' ? 'unblock' : 'block' }}')" title="Block Provider"
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg {{ optional($conversation->provider->user)->status === 'suspended' ? 'text-green-700 bg-green-50 hover:bg-green-100' : 'text-red-700 bg-red-50 hover:bg-red-100' }} transition-colors">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="{{ optional($conversation->provider->user)->status === 'suspended' ? 'M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z' : 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728' }}"/>
                                                </svg>
                                                {{ optional($conversation->provider->user)->status === 'suspended' ? 'Unblock Provider' : 'Block Provider' }}
                                            </button>
                                        @else
                                            <!-- Block Requester Button -->
                                            <button onclick="toggleUserStatus({{ $conversation->requester_id }}, '{{ $conversation->requester->status === 'suspended' ? 'unblock' : 'block' }}')" title="Block Requester"
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg {{ $conversation->requester->status === 'suspended' ? 'text-green-700 bg-green-50 hover:bg-green-100' : 'text-red-700 bg-red-50 hover:bg-red-100' }} transition-colors">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="{{ $conversation->requester->status === 'suspended' ? 'M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z' : 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728' }}"/>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="mx-auto w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Messages Yet</h3>
                <p class="text-gray-500 max-w-sm mx-auto">
                    This conversation doesn't have any messages yet. Messages will appear here once users start communicating about this mission.
                </p>
            </div>
        @endif
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
        <svg class="animate-spin h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="text-gray-700 font-medium">Processing...</span>
    </div>
</div>

<!-- Toast Notifications -->
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

<style>
/* Custom styles for enhanced UI */
.hover\:bg-gray-25:hover {
    background-color: #fafafa;
}

.prose p {
    margin: 0;
    word-wrap: break-word;
}

/* Smooth transitions */
* {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

/* Focus states */
button:focus {
    outline: 2px solid transparent;
    outline-offset: 2px;
}

/* Message highlighting */
.message-highlight {
    background-color: #fef3c7 !important;
    border-left: 4px solid #f59e0b;
    animation: highlight-fade 3s ease-out;
}

@keyframes highlight-fade {
    0% { background-color: #fef3c7; }
    100% { background-color: transparent; }
}

.btn-loading {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn-loading svg {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.toast {
    padding: 12px 16px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    animation: slideIn 0.3s ease-out;
}

.toast.success {
    background-color: #10b981;
    color: white;
}

.toast.error {
    background-color: #ef4444;
    color: white;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
</style>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


async function toggleUserStatus(userId, action) {
    const button = document.querySelector(`[data-user-id="${userId}"] button`);
    const originalContent = button.innerHTML;
    
    // Show loading state
    button.classList.add('btn-loading');
    button.disabled = true;
    
    try {
        const response = await fetch(`/admin/users/${userId}/${action}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
            // Update button appearance
            updateUserActionButton(userId, action === 'block');
            updateUserStatusBadges(userId, action === 'block');
            
            // Show success message
            showToast(`User ${action === 'block' ? 'blocked' : 'unblocked'} successfully`, 'success');
        } else {
            throw new Error(data.message || `Failed to ${action} user`);
        }
    } catch (error) {
        console.error('Error:', error);
        showToast(error.message, 'error');
        
        // Restore original button state
        button.innerHTML = originalContent;
    } finally {
        button.classList.remove('btn-loading');
        button.disabled = false;
    }
}

// Update user action button
function updateUserActionButton(userId, isBlocked) {
    // Update buttons in the user management panel
    const actionDiv = document.querySelector(`.user-action-btn[data-user-id="${userId}"]`);
    if (!actionDiv) return;
    
    const newAction = isBlocked ? 'unblock' : 'block';
    const buttonClass = isBlocked 
        ? 'inline-flex items-center px-4 py-2 text-sm font-medium text-green-700 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 hover:border-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-150'
        : 'inline-flex items-center px-4 py-2 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-150';
    
    const icon = isBlocked 
        ? '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>'
        : '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/></svg>';
    
    const text = isBlocked ? 'Unblock User' : 'Block User';
    
    actionDiv.innerHTML = `
        <button onclick="toggleUserStatus(${userId}, '${newAction}')"
            class="${buttonClass}">
            ${icon}
            <span class="btn-text">${text}</span>
        </button>
    `;
}

// Update user status badges
function updateUserStatusBadges(userId, isBlocked) {
    const badges = document.querySelectorAll(`.user-status-badge[data-user-id="${userId}"] span`);
    
    badges.forEach(badge => {
        if (isBlocked) {
            badge.className = 'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800';
            badge.innerHTML = `
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"/>
                </svg>
                Blocked
            `;
        } else {
            badge.className = 'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800';
            badge.innerHTML = `
                <div class="w-2 h-2 bg-green-400 rounded-full mr-1"></div>
                Active
            `;
        }
    });
}

// Show toast notification
function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;
    
    container.appendChild(toast);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease-out forwards';
        setTimeout(() => container.removeChild(toast), 300);
    }, 3000);
}

// Scroll functions
function scrollToTop() {
    document.getElementById('messagesContainer').scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function scrollToBottom() {
    const container = document.getElementById('messagesContainer');
    container.scrollTo({
        top: container.scrollHeight,
        behavior: 'smooth'
    });
}

// Highlight message
function highlightMessage(messageId) {
    const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
    if (messageElement) {
        messageElement.classList.add('message-highlight');
        messageElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        setTimeout(() => {
            messageElement.classList.remove('message-highlight');
        }, 3000);
    }
}

// Refresh conversation
async function refreshConversation() {
    showToast('Refreshing conversation...', 'success');
    setTimeout(() => {
        window.location.reload();
    }, 1000);
}

// Show/hide loading overlay
function showLoading() {
    document.getElementById('loadingOverlay').classList.remove('hidden');
    document.getElementById('loadingOverlay').classList.add('flex');
}

function hideLoading() {
    document.getElementById('loadingOverlay').classList.add('hidden');
    document.getElementById('loadingOverlay').classList.remove('flex');
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Auto-scroll to bottom on page load
    setTimeout(() => {
        const container = document.getElementById('messagesContainer');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    }, 100);
});
</script>

@endsection