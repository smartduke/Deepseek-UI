<!-- resources/views/chat/partials/sidebar.blade.php -->
<div class="w-64 bg-white dark:bg-gray-800 shadow-lg">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="p-4 border-b dark:border-gray-700">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Deepseek Chat</h1>
        </div>

        <!-- New Chat Button -->
        <div class="p-4">
            <form method="POST" action="{{ route('chat.store') }}">
                @csrf
                <button type="submit" class="w-full bg-blue-600 text-white rounded-lg py-2 px-4 hover:bg-blue-700 transition">
                    New Chat
                </button>
            </form>
        </div>

        <!-- Chat History -->
        <div class="flex-1 overflow-y-auto p-4 space-y-2">
            @foreach($chatSessions as $session)
                <a href="{{ route('chat.show', $session) }}" 
                   class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition 
                          @if(isset($chatSession) && $chatSession->id === $session->id) bg-gray-100 dark:bg-gray-700 @endif">
                    <div class="flex justify-between items-center">
                        <span class="truncate text-gray-900 dark:text-white">{{ $session->title }}</span>
                        <div class="flex space-x-2">
                            <button @click.prevent="renameChat('{{ $session->id }}')" 
                                    class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <form method="POST" action="{{ route('chat.destroy', $session) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Profile Section -->
        @include('chat.partials.profile-menu')
    </div>
</div>