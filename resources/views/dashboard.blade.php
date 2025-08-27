<x-layouts.app :title="__('Dashboard')">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                    Welkom, {{ Auth::user()->name }}! 👋
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
                    <span class="text-4xl mb-4 block">🚨</span>
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
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-blue-500">
                <div class="text-center">
                    <span class="text-4xl mb-4 block">📍</span>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Locaties
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Beheer je belangrijke locaties
                    </p>
                    <a href="{{ route('locations.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        Locaties Beheren
                    </a>
                </div>
            </div>

            <!-- Settings Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-green-500">
                <div class="text-center">
                    <span class="text-4xl mb-4 block">⚙️</span>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Instellingen
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Pas je profiel en voorkeuren aan
                    </p>
                    <a href="{{ route('settings.profile') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <span class="text-green-600 dark:text-green-400 text-2xl mr-3">✅</span>
                        <div>
                            <h3 class="font-semibold text-green-800 dark:text-green-200">Beschermd</h3>
                            <p class="text-green-700 dark:text-green-300 text-sm">Je bent verbonden met het veiligheidsnetwerk</p>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <span class="text-blue-600 dark:text-blue-400 text-2xl mr-3">👥</span>
                        <div>
                            <h3 class="font-semibold text-blue-800 dark:text-blue-200">Netwerk</h3>
                            <p class="text-blue-700 dark:text-blue-300 text-sm">Mensen in je buurt kunnen je helpen</p>
                        </div>
                    </div>
                </div>
                <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <span class="text-purple-600 dark:text-purple-400 text-2xl mr-3">📍</span>
                        <div>
                            <h3 class="font-semibold text-purple-800 dark:text-purple-200">Locaties</h3>
                            <p class="text-purple-700 dark:text-purple-300 text-sm">{{ Auth::user()->locations()->count() }} locatie(s) ingesteld</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location Info -->
        @if(Auth::user()->locations()->count() == 0)
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-lg p-6 mt-8">
                <div class="text-center">
                    <span class="text-4xl mb-4 block">⚠️</span>
                    <h3 class="text-lg font-semibold text-yellow-800 dark:text-yellow-200 mb-2">
                        Voeg je eerste locatie toe
                    </h3>
                    <p class="text-yellow-700 dark:text-yellow-300 mb-4">
                        Om meldingen te kunnen ontvangen van mensen in je buurt, moet je eerst locaties toevoegen zoals thuis, werk of andere belangrijke plekken.
                    </p>
                    <a href="{{ route('locations.index') }}" class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        Locaties Toevoegen
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
