<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Veiligheidsnetwerk - Een innovatief systeem dat mensen in je buurt waarschuwt wanneer je je onveilig voelt. Directe hulp binnen 5 kilometer van je locatie.">

        <title>Veiligheidsnetwerk - Voel je veiliger met hulp in de buurt</title>

        <!-- Favicon -->
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:title" content="Veiligheidsnetwerk - Voel je veiliger met hulp in de buurt" />
        <meta property="og:description" content="Een innovatief systeem dat mensen in je buurt waarschuwt wanneer je je onveilig voelt. Directe hulp binnen 5 kilometer van je locatie." />
        <meta property="og:image" content="{{ url('/og-image.svg') }}" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="{{ url()->current() }}" />
        <meta property="twitter:title" content="Veiligheidsnetwerk - Voel je veiliger met hulp in de buurt" />
        <meta property="twitter:description" content="Een innovatief systeem dat mensen in je buurt waarschuwt wanneer je je onveilig voelt. Directe hulp binnen 5 kilometer van je locatie." />
        <meta property="twitter:image" content="{{ url('/og-image.svg') }}" />

        <!-- Theme Color -->
        <meta name="theme-color" content="#dc2626" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-br from-red-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 text-gray-900 dark:text-white min-h-screen">
        <!-- Development Warning -->
        <div class="bg-yellow-500 text-yellow-900 px-4 py-2 text-center text-sm font-medium">
            <div class="max-w-7xl mx-auto flex items-center justify-center space-x-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span>Ontwikkelingsversie - Dit systeem is nog in ontwikkeling en biedt nog geen garantie voor functionaliteit. Bel bij echte noodsituaties altijd 112.</span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <h1 class="text-xl font-bold text-red-600 dark:text-red-400">
                                Veiligheidsnetwerk
                            </h1>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('explanation.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium">
                            Uitleg
                        </a>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium">
                                Inloggen
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                    Registreren
                                </a>
                            @endif
                           
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                        Voel je veiliger met <span class="text-red-600 dark:text-red-400">hulp in de buurt</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                        Een veiligheidsnetwerk dat mensen in je buurt waarschuwt wanneer je je onveilig voelt. 
                        Directe hulp binnen 3 kilometer van je locatie.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ route('emergency.index') }}" class="inline-flex items-center px-8 py-4 bg-red-600 hover:bg-red-700 text-white text-lg font-semibold rounded-lg transition-colors shadow-lg hover:shadow-xl">
                                🚨 Noodmelding Sturen
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-red-600 hover:bg-red-700 text-white text-lg font-semibold rounded-lg transition-colors shadow-lg hover:shadow-xl">
                                🚨 Noodmelding Sturen
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- How it works -->
        <div class="bg-white dark:bg-gray-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                        Hoe werkt het?
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300">
                        In drie eenvoudige stappen ben je beschermd
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="bg-red-100 dark:bg-red-900/30 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">📱</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">1. Registreer je</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Maak een gratis account aan en voeg je locaties toe (thuis, werk, etc.)
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="bg-red-100 dark:bg-red-900/30 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">🚨</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">2. Druk op de knop</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Wanneer je je onveilig voelt, druk je op de "Ik voel me onveilig" knop
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="bg-red-100 dark:bg-red-900/30 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">🤝</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">3. Krijg hulp</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Mensen binnen 5km krijgen een melding en kunnen je helpen
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Learn More Section -->
        <div class="bg-gray-50 dark:bg-gray-900 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                        Wil je meer weten?
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                        Lees meer over waarom we dit systeem hebben gemaakt en hoe het vrouwen helpt zich veiliger te voelen op straat.
                    </p>
                </div>
                
                <div class="text-center">
                    <a href="{{ route('explanation.index') }}" class="inline-flex items-center px-8 py-4 bg-white dark:bg-gray-800 text-red-600 dark:text-red-400 border-2 border-red-600 dark:border-red-400 text-lg font-semibold rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors shadow-lg">
                        📖 Lees de volledige uitleg
                    </a>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-red-600 dark:bg-red-700 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Ik ben in gevaar
                </h2>
                
                @auth
                    <a href="{{ route('emergency.index') }}" class="inline-flex items-center px-8 py-4 bg-white text-red-600 text-lg font-semibold rounded-lg hover:bg-gray-100 transition-colors shadow-lg">
                        🚨 Noodmelding Sturen
                    </a>
                @else
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-red-600 text-lg font-semibold rounded-lg hover:bg-gray-100 transition-colors shadow-lg">
                            Gratis Registreren
                        </a>
                        
                    </div>
                @endauth
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <p class="text-lg text-yellow-4 00 mt-2">
                        ⚠️ Bel altijd 112 in een noodsituatie
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>
