<!DOCTYPE html>
<html lang="nl" class="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Server fout - Ik Voel Me Onveilig</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="min-h-screen bg-gradient-to-br from-red-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Error Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 border-l-4 border-red-500">
            <!-- Error Icon -->
            <div class="mb-6">
                <svg class="w-24 h-24 text-red-600 dark:text-red-400 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>

            <!-- Error Title -->
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                500
            </h1>
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                Server fout
            </h2>

            <!-- Error Message -->
            <p class="text-gray-600 dark:text-gray-300 text-lg mb-8">
                Er is iets misgegaan op de server. 
                We werken eraan om dit op te lossen. Je bent veilig.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="window.location.reload()" class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Opnieuw proberen
                </button>
                <a href="{{ route('dashboard') }}" class="inline-block bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 px-6 py-3 rounded-lg font-medium transition-colors">
                    Dashboard
                </a>
            </div>

            <!-- Emergency Button -->
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                    Voel je je onveilig?
                </p>
                <a href="{{ route('emergency.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Noodmelding Sturen
                </a>
            </div>
        </div>

        <!-- Logo -->
        <div class="mt-8">
            <a href="{{ route('home') }}" class="text-xl font-bold text-red-600 dark:text-red-400">
                Ik Voel Me Onveilig
            </a>
        </div>
    </div>
</body>
</html>
