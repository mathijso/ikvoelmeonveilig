<x-layouts.app :title="__('Dashboard')">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
       
        <!-- Welcome Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                    Welkom, {{ Auth::user()->name }}
                </h1>
                <p class="text-gray-600 dark:text-gray-300 text-lg">
                    Je bent beschermd door het veiligheidsnetwerk
                </p>
            </div>
        </div>

        <!-- Quick Actions Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Emergency Alert Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-red-500">
                <div class="text-center">
                    <svg class="w-12 h-12 text-red-600 dark:text-red-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Noodmelding
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Stuur een melding als je je onveilig voelt
                    </p>
                    <a href="{{ route('emergency.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        Noodmelding Sturen
                    </a>
                </div>
            </div>

            <!-- Locations Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-red-500">
                <div class="text-center">
                    <svg class="w-12 h-12 text-red-600 dark:text-red-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Locaties
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Beheer je belangrijke locaties
                    </p>
                    <a href="{{ route('locations.index') }}" class="inline-block bg-white hover:bg-gray-50 text-red-600 border-2 border-red-600 hover:border-red-700 px-6 py-3 rounded-lg font-medium transition-colors">
                        Locaties Beheren
                    </a>
                </div>
            </div>

            <!-- Settings Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-red-500">
                <div class="text-center">
                    <svg class="w-12 h-12 text-red-600 dark:text-red-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Instellingen
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Pas je profiel en voorkeuren aan
                    </p>
                    <a href="{{ route('settings.profile') }}" class="inline-block bg-white hover:bg-gray-50 text-red-600 border-2 border-red-600 hover:border-red-700 px-6 py-3 rounded-lg font-medium transition-colors">
                        Instellingen
                    </a>
                </div>
            </div>
        </div>

        <!-- Status Overview -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                Status Overzicht
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <h3 class="font-semibold text-red-800 dark:text-red-200">Beschermd</h3>
                            <p class="text-red-700 dark:text-red-300 text-sm">Je bent verbonden met het veiligheidsnetwerk</p>
                        </div>
                    </div>
                </div>
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold text-red-800 dark:text-red-200">Netwerk</h3>
                            <p class="text-red-700 dark:text-red-300 text-sm">{{ $statistics['nearby_users'] }} mensen binnen 5km</p>
                        </div>
                    </div>
                </div>
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <h3 class="font-semibold text-red-800 dark:text-red-200">Mijn Locaties</h3>
                            <p class="text-red-700 dark:text-red-300 text-sm">{{ $statistics['user_locations'] }} locatie(s) ingesteld</p>
                        </div>
                    </div>
                </div>
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <h3 class="font-semibold text-red-800 dark:text-red-200">Totaal Systeem</h3>
                            <p class="text-red-700 dark:text-red-300 text-sm">{{ $statistics['total_locations'] }} locaties geregistreerd</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location Info -->
        @if(Auth::user()->locations()->count() == 0)
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg p-6 mt-8">
                <div class="text-center">
                    <svg class="w-12 h-12 text-red-600 dark:text-red-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-lg font-semibold text-red-800 dark:text-red-200 mb-2">
                        Voeg je eerste locatie toe
                    </h3>
                    <p class="text-red-700 dark:text-red-300 mb-4">
                        Om meldingen te kunnen ontvangen van mensen in je buurt, moet je eerst locaties toevoegen zoals thuis, werk of andere belangrijke plekken.
                    </p>
                    <a href="{{ route('locations.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        Locaties Toevoegen
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
