<x-layouts.app.header title="Admin Dashboard">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        Admin Dashboard
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">
                        Overzicht van systeem statistieken
                    </p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            Geregistreerde Gebruikers
                        </h3>
                        <p class="text-3xl font-bold text-red-600 dark:text-red-400">
                            {{ number_format($stats['total_users']) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Total Locations Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            Actieve Locaties
                        </h3>
                        <p class="text-3xl font-bold text-red-600 dark:text-red-400">
                            {{ number_format($stats['total_locations']) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                Systeem Informatie
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        Over deze statistieken
                    </h3>
                    <ul class="text-sm text-gray-600 dark:text-gray-300 space-y-1">
                        <li>• <strong>Geregistreerde Gebruikers:</strong> Totaal aantal gebruikers in het systeem</li>
                        <li>• <strong>Actieve Locaties:</strong> Aantal actieve locaties van alle gebruikers</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        Laatste update
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        {{ now()->format('d-m-Y H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app.header>
