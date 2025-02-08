<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50">
        <main class="flex min-h-screen">
            <!-- Left Column - Content -->
            <div class="hidden lg:flex w-1/2 bg-gradient-to-b from-blue-500 to-blue-600 p-12 text-white">
                <div class="max-w-xl my-auto">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3 mb-12">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <span class="text-2xl font-bold">Deepseek UI</span>
                    </div>

                    <h1 class="text-4xl font-bold mb-6">Laravel Chat Interface</h1>
                    
                    <p class="text-lg text-blue-100 mb-8">
                        Connect with our advanced AI for insightful conversations, problem-solving, and creative collaboration.
                    </p>

                    <!-- Feature List -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-blue-400 bg-opacity-20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Natural Conversations</h3>
                                <p class="text-blue-100">Engage in human-like dialogue with contextual understanding</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-blue-400 bg-opacity-20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Seamless Integration</h3>
                                <p class="text-blue-100">Works across devices with chat history sync</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-blue-400 bg-opacity-20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Secure & Private</h3>
                                <p class="text-blue-100">Your conversations are encrypted and private</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Auth Forms -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
                <div class="w-full max-w-md">
                    @auth
                        <!-- Already logged in -->
                        <div class="text-center">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Welcome Back!</h2>
                            <p class="text-gray-600 mb-8">You're already logged in. Ready to start chatting?</p>
                            <a href="{{ route('chat.index') }}" 
                               class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10">
                                Go to Chat
                            </a>
                        </div>
                    @else
                        <!-- Auth Tabs -->
                        <div x-data="{ tab: 'login' }" class="bg-white rounded-xl shadow-sm border p-8">
                            <!-- Tab Headers -->
                            <div class="flex space-x-4 mb-8">
                                <button @click="tab = 'login'" 
                                        :class="{ 'text-blue-600 border-b-2 border-blue-600': tab === 'login', 'text-gray-500': tab !== 'login' }"
                                        class="flex-1 pb-4 text-sm font-medium">
                                    Login
                                </button>
                                <button @click="tab = 'register'"
                                        :class="{ 'text-blue-600 border-b-2 border-blue-600': tab === 'register', 'text-gray-500': tab !== 'register' }"
                                        class="flex-1 pb-4 text-sm font-medium">
                                    Register
                                </button>
                            </div>

                            <!-- Login Form -->
                            <div x-show="tab === 'login'" class="space-y-6">
                                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" id="email" required 
                                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>

                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                        <input type="password" name="password" id="password" required 
                                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="remember" id="remember" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                                        </div>

                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                                                Forgot password?
                                            </a>
                                        @endif
                                    </div>

                                    <button type="submit" 
                                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Sign in
                                    </button>
                                </form>
                            </div>

                            <!-- Register Form -->
                            <div x-show="tab === 'register'" class="space-y-6">
                                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" name="name" id="name" required 
                                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" id="email" required 
                                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>

                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                        <input type="password" name="password" id="password" required 
                                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>

                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" required 
                                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>

                                    <button type="submit" 
                                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Create Account
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </main>
    </body>
</html>