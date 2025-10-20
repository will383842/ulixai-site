@extends('dashboard.layouts.master')

@section('title', 'Private Messaging')

@section('content')
@php
    $activeTab = request('tab') === 'jobs' ? 'jobs' : 'services';
@endphp
<div class="min-h-screen p-4">
    <div class="mx-auto">
        <!-- Header Section -->
        <div class="bg-white/80 backdrop-blur-sm shadow-xl p-6 mb-6 border border-white/20">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-6">
                Private Messaging
            </h1>
            
            <!-- Tab Navigation -->
            <div class="flex gap-4">
                <a href="?tab=services" 
                   class="tab-btn {{ $activeTab === 'services' ? 'active' : '' }} px-6 py-3 rounded-xl font-semibold flex items-center gap-2 shadow-lg">
                    <i class="fas fa-tools"></i>
                    <span>Service Requests</span>
                </a>
                @if($user->user_role === 'service_provider')
                    <a href="?tab=jobs" 
                    class="tab-btn {{ $activeTab === 'jobs' ? 'active' : '' }} px-6 py-3 rounded-xl font-semibold flex items-center gap-2 shadow-lg">
                        <i class="fas fa-briefcase"></i>
                        <span>Job Listings</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 h-[calc(100vh-200px)]">
            <!-- Mission List Sidebar -->
            <div class="lg:col-span-1 bg-white/80 backdrop-blur-sm shadow-xl border border-white/20 p-4 flex flex-col">
                <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-800">Conversations</h2>
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                        {{ count($missions) }}
                    </span>
                </div>
                <div class="flex-1 space-y-3 overflow-y-auto scrollbar-hide">
                    @foreach($missions as $mission)
                        @php
                            $conv = $conversations->firstWhere('mission_id', $mission->id);
                            $un_read = 0;
                            $otherParty = null;
                            if($conv) {
                                if($conv->messages) {
                                    $un_read = $conv->messages()->where('is_read', false)->where('sender_id', '!=', $user->id)->count() ?? ' ';
                                }
                            
                                if ($user->id === $conv->requester->id) {
                                    $otherParty = $conv->provider->first_name ?? null;
                                } elseif($user->id === $conv->provider->user_id) {
                                    $otherParty = explode(' ', $conv->requester->name)[0] ?? null;
                                }
                            }

                        @endphp
                        <div class="mission-card bg-white rounded-xl p-4 cursor-pointer group"
                             data-mission-id="{{ $mission->id }}"
                             data-conversation-id="{{ $conv ? $conv->id : '' }}"
                             data-other-name="{{ $otherParty ?? 'Unknown' }}"
                             data-other-phone="{{ $otherParty->phone_number ?? '' }}">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-semibold text-gray-900 text-sm truncate group-hover:text-blue-600 transition-colors">
                                        {{ $mission->title }}
                                    </h3>

                                    <!-- <p class="text-xs text-gray-600 mb-1">
                                        {{ $otherParty ?? 'Unknown' }}
                                    </p> -->
        
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium mt-2
                                            {{ $mission->status === 'in_progress' ? 'bg-green-100 text-green-800' : 
                                               ($mission->status === 'completed' ? 'bg-blue-100 text-blue-800' : 
                                               ($mission->status === 'disputed' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800 ')) }}">
                                            {{ ucfirst(str_replace('_', ' ', $mission->status)) }}
                                        </span>
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-white text-red-800 rounded-full text-xs font-medium mt-2">
                                            <span class="bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs font-bold" 
                                                data-value="{{ $un_read }}" 
                                                id="conversation_unread_{{ $conv->id ?? '' }}">
                                                {{ $un_read }}
                                            </span>
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 ml-2">{{ $mission->location_city ?? 'Remote' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if(count($missions) === 0)
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-inbox text-3xl mb-3 text-gray-300"></i>
                            <p class="text-sm">No conversations yet</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Chat Interface -->
            <div class="lg:col-span-3 bg-white/80 backdrop-blur-sm  shadow-xl border border-white/20 flex flex-col">
                <!-- Chat Header -->
                <div id="chatHeader" class="p-2 border-b border-gray-200 hidden">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4 w-full">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="w-full flex items-center">
                                <h3 id="chatUserName" class="font-bold text-gray-900 text-md"></h3>
                                <p class="text-xs text-gray-600 mb-1">
                                    <button class="report-conversation-btn ml-2 text-red-500 hover:text-red-700" 
                                            data-report-conversation-id="" 
                                            title="Report Conversation">
                                        <i class="fas fa-flag"></i>
                                    </button>
                                </p>
                                <div class="flex items-center gap-2">
                                    <span id="chatPhone" class="text-sm text-gray-600"></span>
                                    <!-- <div class="flex items-center gap-1">
                                        <div id="onlineStatus" class="w-2 h-2 bg-gray-400 rounded-full"></div>
                                        <span id="statusText" class="text-xs text-gray-500">Offline</span>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <button id="closeChatBtn" class="p-2 hover:bg-gray-100 rounded-lg transition-colors text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Messages Container -->
                <div class="flex-1 flex flex-col min-h-0">
                    <!-- Empty State -->
                    <div id="emptyState" class="flex-1 flex items-center justify-center p-8">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-comments text-3xl text-blue-500"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Select a Conversation</h3>
                            <p class="text-gray-600">Choose a mission from the sidebar to start messaging</p>
                        </div>
                    </div>

                    <!-- Messages Area -->
                    <div id="messagesContainer" class="flex-1 p-6 overflow-y-auto scrollbar-hide hidden">
                        <div id="chatMessages" class="space-y-4 md:max-h-[600px] sm:max-h-[400px] overflow-y-auto"></div>
                        <div id="typingIndicator" class="hidden">
                            <div class="flex items-center gap-2 text-gray-500 text-sm">
                                <div class="flex gap-1">
                                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                </div>
                                <span>Typing...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- File Preview Area -->
                <div id="attachmentPreview" class="px-6 py-3 border-t border-gray-100 hidden">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-paperclip text-blue-500"></i>
                            Attachments
                        </span>
                        <button id="clearAttachments" class="text-gray-400 hover:text-red-500 transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div id="previewContainer" class="flex gap-3 overflow-x-auto scrollbar-hide pb-2"></div>
                </div>

                <!-- Message Input -->
                <div id="messageInputArea" class="p-6 border-t border-gray-200 hidden">
                    <form id="chatForm" class="flex items-end gap-3">
                        <input type="hidden" id="conversationId">
                        
                        <!-- File Upload Button -->
                        <div class="flex flex-col gap-2">
                            <input type="file" id="fileInput" multiple accept="image/*,.pdf,.doc,.docx" class="hidden">
                            <button type="button" id="attachBtn" class="p-3 bg-gray-100 hover:bg-blue-100 rounded-xl transition-colors group">
                                <i class="fas fa-paperclip text-gray-600 group-hover:text-blue-600"></i>
                            </button>
                        </div>

                        <!-- Message Input Field -->
                        <div class="flex-1 relative">
                            <input type="text" id="chatInput" placeholder="Type your message..." 
                                   class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                            <button type="submit" id="sendBtn" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-lg transition-all transform hover:scale-105">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Report Conversation Modal -->
<div id="reportModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <h2 class="text-lg font-bold mb-2 text-gray-800">Report Conversation</h2>
        <p class="text-sm text-gray-600 mb-4">Please provide a reason for reporting this conversation:</p>
        <textarea id="reportReasonInput" class="w-full border border-gray-300 rounded p-2 mb-4" rows="3" placeholder="Reason..."></textarea>
        <div class="flex justify-end gap-2">
            <button id="cancelReportBtn" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700">Cancel</button>
            <button id="submitReportBtn" class="px-4 py-2 rounded bg-red-500 hover:bg-red-600 text-white">Submit</button>
        </div>
    </div>
</div>
<script>
    let currentConversationId = null;
    let selectedFiles = [];
    let userId = {{ $user->id }};
    let conversationChannel = null; 
    let lastMessageTimestamp = null;
    let reportConversationId = null;

    // DOM Elements
    const elements = {
        chatHeader: document.getElementById('chatHeader'),
        chatUserName: document.getElementById('chatUserName'),
        chatPhone: document.getElementById('chatPhone'),
        onlineStatus: document.getElementById('onlineStatus'),
        statusText: document.getElementById('statusText'),
        emptyState: document.getElementById('emptyState'),
        messagesContainer: document.getElementById('messagesContainer'),
        chatMessages: document.getElementById('chatMessages'),
        messageInputArea: document.getElementById('messageInputArea'),
        chatForm: document.getElementById('chatForm'),
        chatInput: document.getElementById('chatInput'),
        fileInput: document.getElementById('fileInput'),
        attachBtn: document.getElementById('attachBtn'),
        attachmentPreview: document.getElementById('attachmentPreview'),
        previewContainer: document.getElementById('previewContainer'),
        clearAttachments: document.getElementById('clearAttachments'),
        closeChatBtn: document.getElementById('closeChatBtn'),
        conversationId: document.getElementById('conversationId')
    };

    const utils = {
        formatTime(timestamp) {
            return new Date(timestamp).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        },

        scrollToBottom() {
            elements.messagesContainer.scrollTop = elements.messagesContainer.scrollHeight;
        },

        showNotification(message, type = 'info') {
            // console.log(`${type.toUpperCase()}: ${message}`);
        }
    };

    const messageManager = {
        renderMessage(message) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message-animation ${message.sender_id === userId ? 'flex justify-end' : 'flex justify-start'}`;
            messageDiv.setAttribute('data-message-id', message.id);
            
            const isOwn = message.sender_id === userId;
            const bubbleClass = isOwn 
                ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-tl-2xl rounded-tr-2xl rounded-bl-2xl'
                : 'bg-gray-100 text-gray-800 rounded-tl-2xl rounded-tr-2xl rounded-br-2xl';

            messageDiv.innerHTML = `
                <div class="max-w-xs lg:max-w-md px-4 py-3 ${bubbleClass} shadow-lg">
                    ${message.body ? `<p class="text-sm mb-2">${this.escapeHtml(message.body)}</p>` : ''}
                    ${message.attachments && message.attachments.length > 0 ? this.renderAttachments(message.attachments, isOwn) : ''}
                    <div class="text-xs mt-1 ${isOwn ? 'text-blue-100' : 'text-gray-500'}">
                        ${utils.formatTime(message.created_at)}
                    </div>
                </div>
            `;

            return messageDiv;
        },

        renderAttachments(attachments, isOwn) {
            if (!attachments || attachments.length === 0) return '';
            
            return `
                <div class="mt-2 space-y-2">
                    ${attachments.map(att => {
                        const isImage = att.mime_type && att.mime_type.startsWith('image/');
                        const iconClass = this.getFileIcon(att.mime_type);
                        const downloadUrl = `/attachments/${att.id}/download`;
                        const viewUrl = att.url || `/storage/${att.path}`;
                        
                        if (isImage) {
                            return `
                                <div class="bg-white/20 rounded-lg p-2 cursor-pointer" onclick="openImageModal('${viewUrl}', '${att.filename}')">
                                    <img src="${viewUrl}" alt="${att.filename}" class="max-w-full h-32 object-cover rounded">
                                    <div class="text-xs mt-1 flex items-center justify-between">
                                        <span class="truncate flex-1">${att.filename}</span>
                                        <a href="${downloadUrl}" download class="ml-2 ${isOwn ? 'text-blue-100 hover:text-white' : 'text-blue-600 hover:text-blue-800'}" onclick="event.stopPropagation()">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            `;
                        } else {
                            return `
                                <div class="bg-white/20 rounded-lg p-3 flex items-center justify-between">
                                    <div class="flex items-center flex-1 min-w-0">
                                        <i class="${iconClass} text-lg mr-2"></i>
                                        <div class="min-w-0 flex-1">
                                            <div class="text-xs font-medium truncate">${att.filename}</div>
                                            <div class="text-xs opacity-75">${att.formatted_size || this.formatFileSize(att.size)}</div>
                                        </div>
                                    </div>
                                    <a href="${downloadUrl}" download class="ml-2 ${isOwn ? 'text-blue-100 hover:text-white' : 'text-blue-600 hover:text-blue-800'}">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            `;
                        }
                    }).join('')}
                </div>
            `;
        },

        getFileIcon(mimeType) {
            if (!mimeType) return 'fas fa-file';
            
            if (mimeType.startsWith('image/')) return 'fas fa-image';
            if (mimeType.includes('pdf')) return 'fas fa-file-pdf';
            if (mimeType.includes('word') || mimeType.includes('document')) return 'fas fa-file-word';
            if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'fas fa-file-excel';
            if (mimeType.includes('powerpoint') || mimeType.includes('presentation')) return 'fas fa-file-powerpoint';
            if (mimeType.startsWith('video/')) return 'fas fa-file-video';
            if (mimeType.startsWith('audio/')) return 'fas fa-file-audio';
            
            return 'fas fa-file';
        },

        formatFileSize(bytes) {
            if (!bytes) return '0 bytes';
            
            if (bytes >= 1073741824) {
                return (bytes / 1073741824).toFixed(2) + ' GB';
            } else if (bytes >= 1048576) {
                return (bytes / 1048576).toFixed(2) + ' MB';
            } else if (bytes >= 1024) {
                return (bytes / 1024).toFixed(2) + ' KB';
            } else {
                return bytes + ' bytes';
            }
        },

        escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        },

        addMessage(message) {
            const existingMessage = document.querySelector(`[data-message-id="${message.id}"]`);
            if (existingMessage) {
                return; 
            }

            const messageElement = this.renderMessage(message);
            elements.chatMessages.appendChild(messageElement);
            utils.scrollToBottom();
            
            lastMessageTimestamp = message.created_at;
        },

        loadMessages(messages) {
            elements.chatMessages.innerHTML = '';
            lastMessageTimestamp = null;
            
            messages.forEach(message => {
                const messageElement = this.renderMessage(message);
                elements.chatMessages.appendChild(messageElement);
            });
            
            if (messages.length > 0) {
                lastMessageTimestamp = messages[messages.length - 1].created_at;
            }
            
            utils.scrollToBottom();
        },

        // Handle new message from broadcasted channel
        handleBroadcastMessage(data) {
            const message = data.message;
            if (message.conversation_id == currentConversationId) {
                this.addMessage(message);
            }
        }
    };

    // Broadcasting Management
    const broadcastManager = {
        subscribeToConversation(conversationId) {
            this.unsubscribeFromConversation();
            
            if (!window.Echo) {
                console.error('Laravel Echo is not initialized');
                return;
            }
            
            conversationChannel = window.Echo.channel(`conversation.${conversationId}`)
                .listen('MessageSent', (data) => {
                    messageManager.handleBroadcastMessage(data);
                })
                .error((error) => {
                    console.error('Channel subscription error:', error);
                });
        },
        
        unsubscribeFromConversation() {
            if (conversationChannel) {
                window.Echo.leave(`conversation.${currentConversationId}`);
                conversationChannel = null;
                console.log('Unsubscribed from conversation channel');
            }
        }
    };

    // Chat Management - Updated to use broadcasting instead of polling
    const chatManager = {
        openChat(conversationId, userName, phone, missionId) {
            currentConversationId = conversationId;
            
            // Update UI
            elements.emptyState.classList.add('hidden');
            elements.chatHeader.classList.remove('hidden');
            elements.messagesContainer.classList.remove('hidden');
            elements.messageInputArea.classList.remove('hidden');
            
            elements.chatUserName.textContent = userName;
            elements.chatPhone.textContent = phone;
            elements.conversationId.value = conversationId;

            // Update active mission card
            document.querySelectorAll('.mission-card').forEach(card => {
                card.classList.remove('active');
            });
            document.querySelector(`[data-conversation-id="${conversationId}"]`)?.classList.add('active');
            const reportBtn = document.querySelector('.report-conversation-btn');
            if (reportBtn) {

                reportBtn.setAttribute('data-report-conversation-id', conversationId);
            }

            this.loadMessages(conversationId);

            broadcastManager.subscribeToConversation(conversationId);
        },

        closeChat() {
            broadcastManager.unsubscribeFromConversation();
            
            currentConversationId = null;
            lastMessageTimestamp = null;
            
            elements.chatHeader.classList.add('hidden');
            elements.messagesContainer.classList.add('hidden');
            elements.messageInputArea.classList.add('hidden');
            elements.emptyState.classList.remove('hidden');
            
            document.querySelectorAll('.mission-card').forEach(card => {
                card.classList.remove('active');
            });
            
            fileManager.clearAttachments();
        },

        async loadMessages(conversationId) {
            try {
                const response = await fetch(`/conversations/${conversationId}/messages`);
                if (!response.ok) throw new Error('Failed to load messages');
                
                const messages = await response.json();
                messageManager.loadMessages(messages);
            } catch (error) {
                console.error('Error loading messages:', error);
                utils.showNotification('Failed to load messages', 'error');
            }
        },

        async sendMessage() {
            const messageText = elements.chatInput.value.trim();
            if (!messageText && selectedFiles.length === 0) return;
            if (!currentConversationId) return;

            try {
                const formData = new FormData();
                formData.append('body', messageText);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                
                selectedFiles.forEach((file, index) => {
                    formData.append(`files[${index}]`, file);
                });

                const response = await fetch(`/conversations/${currentConversationId}/message`, {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Failed to send message');
                }

                const result = await response.json();
                
                // Clear input and attachments
                elements.chatInput.value = '';
                fileManager.clearAttachments();
                
                // Show success message
                utils.showNotification('Message sent successfully', 'success');
                
            } catch (error) {
                console.error('Error sending message:', error);
                utils.showNotification(error.message || 'Failed to send message', 'error');
            }
        },

        async startConversation(missionId) {
            try {
                const response = await fetch('/conversations/start', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        mission_id: missionId
                    })
                });

                if (!response.ok) throw new Error('Failed to start conversation');
                
                const conversation = await response.json();
                return conversation.id;
            } catch (error) {
                console.error('Error starting conversation:', error);
                utils.showNotification('Failed to start conversation', 'error');
                return null;
            }
        }
    };

    window.openImageModal = function(imageSrc, filename) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50';
        modal.innerHTML = `
            <div class="max-w-4xl max-h-full p-4">
                <div class="bg-white rounded-lg overflow-hidden">
                    <div class="flex items-center justify-between p-4 border-b">
                        <h3 class="text-lg font-semibold truncate">${filename}</h3>
                        <button onclick="closeImageModal()" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <img src="${imageSrc}" alt="${filename}" class="max-w-full max-h-96 object-contain mx-auto">
                    </div>
                    <div class="p-4 border-t bg-gray-50 flex justify-end">
                        <a href="${imageSrc.replace('/storage/', '/attachments/').replace('/download', '')}/download" 
                        download 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-download mr-2"></i>Download
                        </a>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // Close on outside click
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeImageModal();
            }
        });
    };

    window.closeImageModal = function() {
        const modal = document.querySelector('.fixed.inset-0.bg-black');
        if (modal) {
            modal.remove();
        }
    };

    // File Manager (assuming this exists - add if missing)
    const fileManager = {
        handleFileSelect(files) {
            selectedFiles = Array.from(files);
            this.updatePreview();
        },

        updatePreview() {
            if (selectedFiles.length === 0) {
                elements.attachmentPreview.classList.add('hidden');
                return;
            }

            elements.attachmentPreview.classList.remove('hidden');
            elements.previewContainer.innerHTML = selectedFiles.map((file, index) => {
                const isImage = file.type.startsWith('image/');
                const fileSize = this.formatFileSize(file.size);
                
                return `
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 flex items-center justify-between min-w-0">
                        <div class="flex items-center min-w-0 flex-1">
                            ${isImage ? 
                                `<img src="${URL.createObjectURL(file)}" alt="Preview" class="w-10 h-10 object-cover rounded mr-3">` :
                                `<i class="${this.getFileIcon(file.type)} text-lg mr-3 text-gray-600"></i>`
                            }
                            <div class="min-w-0 flex-1">
                                <div class="text-sm font-medium text-gray-900 truncate">${file.name}</div>
                                <div class="text-xs text-gray-500">${fileSize}</div>
                            </div>
                        </div>
                        <button type="button" onclick="removeFile(${index})" class="ml-2 text-red-500 hover:text-red-700 flex-shrink-0">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            }).join('');
        },

        getFileIcon(mimeType) {
            if (!mimeType) return 'fas fa-file';
            
            if (mimeType.startsWith('image/')) return 'fas fa-image';
            if (mimeType.includes('pdf')) return 'fas fa-file-pdf';
            if (mimeType.includes('word') || mimeType.includes('document')) return 'fas fa-file-word';
            
            return 'fas fa-file';
        },

        formatFileSize(bytes) {
            if (bytes >= 1048576) {
                return (bytes / 1048576).toFixed(2) + ' MB';
            } else if (bytes >= 1024) {
                return (bytes / 1024).toFixed(2) + ' KB';
            } else {
                return bytes + ' bytes';
            }
        },

        clearAttachments() {
            selectedFiles = [];
            elements.fileInput.value = '';
            elements.attachmentPreview.classList.add('hidden');
            
            // Clean up object URLs to prevent memory leaks
            elements.previewContainer.querySelectorAll('img').forEach(img => {
                if (img.src.startsWith('blob:')) {
                    URL.revokeObjectURL(img.src);
                }
            });
        }
    };

    // Event Listeners
    function initializeEventListeners() {
        document.querySelectorAll('.mission-card').forEach(card => {
            card.addEventListener('click', async function() {

                let conversationId = this.dataset.conversationId;
                const missionId = this.dataset.missionId;
                const userName = this.dataset.otherName;
                const phone = this.dataset.otherPhone;
                const isReadElement = document.getElementById(`conversation_unread_${conversationId}`);
                const navReadElement = document.getElementById('private_messages_notification');
                if(isReadElement) {
                    const currentVal = isReadElement.dataset.value || "0";
                    const navValue = navReadElement.dataset.value || "0";
                    isReadElement.dataset.value = 0;
                    isReadElement.classList.add('hidden');
                    navReadElement.dataset.value = parseInt(navValue, 10) - currentVal;
                    navReadElement.textContent = navReadElement.dataset.value;
                }

                if (!conversationId) {
                    conversationId = await chatManager.startConversation(missionId);
                    if (conversationId) {
                        this.dataset.conversationId = conversationId;
                    } else {
                        return;
                    }
                }
                
                chatManager.openChat(conversationId, userName, phone, missionId);
            });
        });

        elements.closeChatBtn.addEventListener('click', () => {
            chatManager.closeChat();
        });

        elements.attachBtn.addEventListener('click', () => {
            elements.fileInput.click();
        });

        elements.fileInput.addEventListener('change', (e) => {
            fileManager.handleFileSelect(e.target.files);
        });

        elements.clearAttachments.addEventListener('click', () => {
            fileManager.clearAttachments();
        });

        elements.chatForm.addEventListener('submit', (e) => {
            e.preventDefault();
            chatManager.sendMessage();
        });

        elements.chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                chatManager.sendMessage();
            }
        });
    }

    window.removeFile = function(index) {
        selectedFiles.splice(index, 1);
        fileManager.updatePreview();
    };

    function initializeEchoMonitoring() {
        if (window.Echo) {
            window.Echo.connector.pusher.connection.bind('connected', () => {
                console.log('WebSocket connected');
                utils.showNotification('Connected to real-time messaging', 'success');
            });

            window.Echo.connector.pusher.connection.bind('disconnected', () => {
                console.log('WebSocket disconnected');
                utils.showNotification('Disconnected from real-time messaging', 'warning');
            });

            window.Echo.connector.pusher.connection.bind('error', (error) => {
                console.error('WebSocket error:', error);
                utils.showNotification('Real-time messaging error', 'error');
            });
        }
    }

    // Initialize the application
    document.addEventListener('DOMContentLoaded', function() {
        initializeEventListeners();
        initializeEchoMonitoring();
         initializeReportButtons(); // <-- Add this line!
    });

    // Cleanup on page unload
    window.addEventListener('beforeunload', () => {
        broadcastManager.unsubscribeFromConversation();
    });

    function initializeReportButtons() {
        document.querySelectorAll('.report-conversation-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                reportConversationId = this.dataset.conversationId;
                document.getElementById('reportReasonInput').value = '';
                document.getElementById('reportModal').classList.remove('hidden');
            });
        });

        document.getElementById('cancelReportBtn').onclick = function() {
            document.getElementById('reportModal').classList.add('hidden');
            reportConversationId = null;
        };

        document.getElementById('submitReportBtn').onclick = async function() {
            const reason = document.getElementById('reportReasonInput').value;
            const reportBtn = document.querySelector('.report-conversation-btn');
            let convId = null;
            if (reportBtn) {
                convId = reportBtn.getAttribute('data-report-conversation-id');
            }
            
            if (!convId) return;
            const res = await fetch(`/conversations/${convId}/report`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ reason })
            });
            const data = await res.json();
            document.getElementById('reportModal').classList.add('hidden');
            reportConversationId = null;
            // Optionally show a toast or notification here
            if(res.ok) {
                toastr.success(data.message, 'Success');
            } else {
                toastr.error(data.message, 'Error');
            }
        };
    }

    function handleNotification(data) {
        if (currentConversationId == data.conversation.id) {
            fetch(`/isRead/${data.message.id}/message`,  {
                method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
            })
            .then(response => response.json())
            .then(messages => {
            })
            .catch(error => {
                console.error('Error loading messages:', error);
            });
            return;
        }

        const isReadElement = document.getElementById(`conversation_unread_${data.conversation.id}`);
        if (isReadElement) {
            const oldValue = parseInt(isReadElement.dataset.value || "0", 10);
            const newValue = oldValue + 1;
            isReadElement.dataset.value = newValue;
            isReadElement.textContent = newValue;
            isReadElement.classList.remove('hidden');
        }
    }

    const listenNotifications  = window.Echo.channel(`notify-user-${userId}`)
                .listen('NotifyUser', (data) => {
                    handleNotification(data);
                })
                .error((error) => {
                    console.error('Channel subscription error:', error);
                });
</script>
<div class="mb-96"></div>

<style scoped>
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .message-animation {
        animation: slideIn 0.3s ease-out;
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .mission-card {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .mission-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .mission-card.active {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }
    .online-status {
        animation: pulse 2s infinite;
    }
    .file-preview {
        max-width: 80px;
        max-height: 80px;
        object-fit: cover;
    }
    .tab-btn {
        background:  #3b82f6;
        color: white;
        transition: all 0.3s ease;
    }
    .tab-btn:not(.active) {
        background: #f8fafc;
        color: #64748b;
        border: 2px solid #e2e8f0;
    }
    .tab-btn:not(.active):hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }
    .attachment-preview img {
        transition: transform 0.2s ease;
    }

    .attachment-preview:hover img {
        transform: scale(1.05);
    }

    .file-icon {
        font-size: 1.2rem;
        color: #6b7280;
    }

    .download-btn {
        transition: all 0.2s ease;
    }

    .download-btn:hover {
        transform: scale(1.1);
    }

    .modal-overlay {
        backdrop-filter: blur(4px);
    }

    .file-preview-container {
        max-height: 120px;
        overflow-y: auto;
    }

    .file-preview-item {
        transition: all 0.2s ease;
    }

    .file-preview-item:hover {
        background-color: #f9fafb;
        border-color: #d1d5db;
    }

    .image-thumbnail {
        border-radius: 4px;
        border: 1px solid #e5e7eb;
    }

    /* Loading states */
    .sending-message {
        opacity: 0.7;
        pointer-events: none;
    }

    .upload-progress {
        background: linear-gradient(90deg, #3b82f6 0%, #8b5cf6 100%);
        height: 2px;
        border-radius: 1px;
        animation: progress 1s ease-in-out infinite;
    }

    @keyframes progress {
        0% { width: 0%; }
        50% { width: 70%; }
        100% { width: 100%; }
    }
</style>
@endsection