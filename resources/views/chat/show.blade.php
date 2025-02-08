<x-chat-layout>
    <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        @include('chat.partials.sidebar')

        <!-- Main Chat Area -->
        <div class="flex-1 flex flex-col">
            <!-- Chat Header -->
            <div class="bg-white dark:bg-gray-800 shadow-sm p-4">
                <h1 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $chatSession->title }}</h1>
            </div>

            <!-- Messages -->
            <div id="messages" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 dark:bg-gray-900">
                @foreach($messages as $message)
                    <div class="flex {{ $message->role === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-2xl rounded-lg p-4 {{ $message->role === 'user' ? 'bg-blue-600 text-white' : 'bg-white dark:bg-gray-800 shadow dark:text-gray-200' }}">
                            {!! nl2br(e($message->content)) !!}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Input -->
            <div class="p-4 bg-white dark:bg-gray-800 border-t dark:border-gray-700">
                <form id="messageForm" class="flex space-x-4">
                    <textarea
                        id="messageInput"
                        class="flex-1 border dark:border-gray-600 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400"
                        placeholder="Type your message..."
                        rows="1"
                    ></textarea>
                    <button type="submit" class="bg-blue-600 text-white rounded-lg px-6 py-2 hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>

    @include('chat.partials.rename-modal')

    @push('scripts')
    <script>
        const messageForm = document.getElementById('messageForm');
        const messageInput = document.getElementById('messageInput');
        const messagesContainer = document.getElementById('messages');
        const submitButton = messageForm.querySelector('button[type="submit"]');
        let isProcessing = false;

        // Auto-scroll to bottom on page load
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        messageForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            if (isProcessing) return;
            
            const message = messageInput.value.trim();
            if (!message) return;

            try {
                isProcessing = true;
                submitButton.disabled = true;
                messageInput.disabled = true;

                // Add user message immediately
                appendMessage({
                    role: 'user',
                    content: message
                });

                messageInput.value = '';
                messageInput.style.height = 'auto';

                // Add loading indicator
                const loadingDiv = document.createElement('div');
                loadingDiv.className = 'flex justify-start chat-message-appear';
                loadingDiv.innerHTML = `
                    <div class="max-w-2xl rounded-lg p-4 bg-white shadow">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                        </div>
                    </div>
                `;
                messagesContainer.appendChild(loadingDiv);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
                
                const response = await fetch('{{ route("chat.message", $chatSession) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ message })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                
                // Remove loading indicator
                loadingDiv.remove();
                
                // Add assistant message
                appendMessage(data.assistant_message);

            } catch (error) {
                console.error('Error sending message:', error);
                // Show error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'p-4 bg-red-100 text-red-700 rounded-lg mb-4 chat-message-appear';
                errorDiv.textContent = 'Failed to send message. Please try again.';
                messagesContainer.appendChild(errorDiv);
                setTimeout(() => errorDiv.remove(), 5000);
            } finally {
                isProcessing = false;
                submitButton.disabled = false;
                messageInput.disabled = false;
                messageInput.focus();
            }
        });

        function appendMessage(message) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex ${message.role === 'user' ? 'justify-end' : 'justify-start'} chat-message-appear`;
            
            messageDiv.innerHTML = `
                <div class="max-w-2xl rounded-lg p-4 ${message.role === 'user' ? 'bg-blue-600 text-white' : 'bg-white dark:bg-gray-800 shadow dark:text-gray-200'}">
                    ${message.content.replace(/\n/g, '<br>')}
                </div>
            `;
            
            messagesContainer.appendChild(messageDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Auto-resize textarea
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // Handle Ctrl+Enter to submit
        messageInput.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                messageForm.dispatchEvent(new Event('submit'));
            }
        });

        // Focus input on page load
        messageInput.focus();

        // Keep messages scrolled to bottom when window is resized
        window.addEventListener('resize', () => {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        });
    </script>
    @endpush
</x-chat-layout>