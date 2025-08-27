<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gradient-to-br from-red-50 to-pink-50 dark:from-gray-900 dark:to-gray-800">
        <!-- Development Warning -->
        <div class="bg-yellow-500 text-yellow-900 px-3 sm:px-4 py-2 sm:py-3 text-center text-xs sm:text-sm font-medium">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-3">
                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <div class="flex flex-col sm:flex-row items-center gap-1 sm:gap-2">
                        <span class="font-semibold">Ontwikkelingsversie</span>
                        <span class="hidden sm:inline">-</span>
                        <span class="text-center">Dit systeem is nog in ontwikkeling en biedt nog geen garantie voor functionaliteit.</span>
                        <span class="hidden sm:inline">-</span>
                        <span class="font-semibold">Bel bij echte noodsituaties altijd 112.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Simple Header -->
        <header class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
                <div class="flex justify-between items-center h-14 sm:h-16">
                    <!-- Logo and Title -->
                    <div class="flex items-center min-w-0">
                        <a href="{{ route('home') }}" class="text-lg sm:text-xl font-bold text-red-600 dark:text-red-400 truncate">
                            Veiligheidsnetwerk
                        </a>
                    </div>

                    <!-- Navigation -->
                    <nav class="hidden md:flex items-center space-x-4 lg:space-x-6">
                        <a href="{{ route('dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-2 sm:px-3 py-2 rounded-md text-sm font-medium whitespace-nowrap {{ request()->routeIs('dashboard') ? 'text-red-600 dark:text-red-400' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('locations.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-2 sm:px-3 py-2 rounded-md text-sm font-medium whitespace-nowrap {{ request()->routeIs('locations.*') ? 'text-red-600 dark:text-red-400' : '' }}">
                            Locaties
                        </a>
                        <a href="{{ route('emergency.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-2 sm:px-3 py-2 rounded-md text-sm font-medium whitespace-nowrap {{ request()->routeIs('emergency.*') ? 'text-red-600 dark:text-red-400' : '' }}">
                            Noodmelding
                        </a>
                    </nav>

                    <!-- Emergency Button (Mobile) -->
                    <div class="md:hidden">
                        <a href="{{ route('emergency.index') }}" class="bg-red-600 hover:bg-red-700 text-white px-2 sm:px-3 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors whitespace-nowrap">
                            Noodmelding
                        </a>
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center space-x-2 sm:space-x-4">
                        <!-- Emergency Button (Desktop) -->
                        <a href="{{ route('emergency.index') }}" class="hidden md:block bg-red-600 hover:bg-red-700 text-white px-3 sm:px-4 py-2 rounded-md text-sm font-medium transition-colors whitespace-nowrap">
                            Noodmelding
                        </a>

                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-1 sm:space-x-2 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-xs sm:text-sm font-medium text-red-600 dark:text-red-400">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </div>
                                <span class="hidden lg:block text-sm font-medium truncate max-w-24">{{ auth()->user()->name }}</span>
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Instellingen
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Uitloggen
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
            <div class="px-3 sm:px-4 py-2">
                <button @click="open = !open" class="w-full flex items-center justify-between text-gray-700 dark:text-gray-300">
                    <span class="text-sm font-medium">Menu</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
            
            <div x-show="open" x-cloak class="px-3 sm:px-4 pb-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                    Dashboard
                </a>
                <a href="{{ route('locations.index') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                    Locaties
                </a>
                <a href="{{ route('emergency.index') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                    Noodmelding
                </a>
                <a href="{{ route('settings.profile') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                    Instellingen
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
