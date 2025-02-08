<!-- resources/views/chat/index.blade.php -->
<x-chat-layout>
    <div class="flex h-screen bg-gray-100 dark:bg-gray-900" x-data="{ sidebarOpen: false }">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" 
             class="fixed inset-0 bg-black bg-opacity-50 lg:hidden" 
             @click="sidebarOpen = false"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>

        <!-- Sidebar for Desktop -->
        <div class="hidden lg:block lg:w-64">
            @include('chat.partials.sidebar')
        </div>

        <!-- Mobile Sidebar -->
        <div x-show="sidebarOpen" 
             class="fixed inset-y-0 left-0 z-40 w-64 lg:hidden transform transition ease-in-out duration-300"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             @click.away="sidebarOpen = false">
            @include('chat.partials.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header with Menu Button -->
            <div class="bg-white dark:bg-gray-800 shadow-sm p-4 lg:hidden">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <div class="flex-1 p-6 flex items-center justify-center">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Welcome to Deepseek Chat</h1>
                    <p class="text-gray-600 dark:text-gray-400">Start a new chat or select an existing conversation</p>
                </div>
            </div>
        </div>
    </div>

    @include('chat.partials.rename-modal')
</x-chat-layout>