<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gradient-to-br from-red-50 to-pink-50 dark:from-gray-900 dark:to-gray-800">
        <!-- Simple Header -->
        <header class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo and Title -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-xl font-bold text-red-600 dark:text-red-400">
                            Ik Voel Me Onveilig
                        </a>
                    </div>

                    <!-- Navigation -->
                    <nav class="hidden md:flex items-center space-x-6">
                        <a href="{{ route('dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-red-600 dark:text-red-400' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('locations.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('locations.*') ? 'text-red-600 dark:text-red-400' : '' }}">
                            Locaties
                        </a>
                        <a href="{{ route('emergency.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('emergency.*') ? 'text-red-600 dark:text-red-400' : '' }}">
                            Noodmelding
                        </a>
                    </nav>

                    <!-- Emergency Button (Mobile) -->
                    <div class="md:hidden">
                        <a href="{{ route('emergency.index') }}" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            🚨
                        </a>
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center space-x-4">
                        <!-- Emergency Button (Desktop) -->
                        <a href="{{ route('emergency.index') }}" class="hidden md:block bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            🚨 Noodmelding
                        </a>

                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400">
                                <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-red-600 dark:text-red-400">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </div>
                                <span class="hidden md:block text-sm font-medium">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    👤 Instellingen
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        🚪 Uitloggen
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Menu -->
        <div class="md:hidden bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700" x-data="{ open: false }">
            <div class="px-4 py-2">
                <button @click="open = !open" class="w-full flex items-center justify-between text-gray-700 dark:text-gray-300">
                    <span class="text-sm font-medium">Menu</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
            
            <div x-show="open" x-cloak class="px-4 pb-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                    📊 Dashboard
                </a>
                <a href="{{ route('locations.index') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                    📍 Locaties
                </a>
                <a href="{{ route('emergency.index') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                    🚨 Noodmelding
                </a>
                <a href="{{ route('settings.profile') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                    👤 Instellingen
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        @fluxScripts
    </body>
</html>
