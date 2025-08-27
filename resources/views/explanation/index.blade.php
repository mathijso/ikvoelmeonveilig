<!DOCTYPE html>
<html lang="nl" class="h-full">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hoe werkt het Veiligheidsnetwerk? - Uitleg</title>
        <meta name="description" content="Leer hoe het Veiligheidsnetwerk werkt en waarom we het hebben gemaakt om vrouwen veiliger te laten voelen en sociale controle te verbeteren.">
        
        <!-- Favicon -->
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:title" content="Hoe werkt het Veiligheidsnetwerk? - Uitleg" />
        <meta property="og:description" content="Leer hoe het Veiligheidsnetwerk werkt en waarom we het hebben gemaakt om vrouwen veiliger te laten voelen en sociale controle te verbeteren." />
        <meta property="og:image" content="{{ url('/og-image.svg') }}" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="{{ url()->current() }}" />
        <meta property="twitter:title" content="Hoe werkt het Veiligheidsnetwerk? - Uitleg" />
        <meta property="twitter:description" content="Leer hoe het Veiligheidsnetwerk werkt en waarom we het hebben gemaakt om vrouwen veiliger te laten voelen en sociale controle te verbeteren." />
        <meta property="twitter:image" content="{{ url('/og-image.svg') }}" />

        <!-- Theme Color -->
        <meta name="theme-color" content="#dc2626" />
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                        'mono': ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900">
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
    <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <span class="font-mono text-xl font-semibold text-red-600 dark:text-red-400">Veiligheidsnetwerk</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium">
                        Home
                    </a>
                    <a href="{{ route('explanation.index') }}" class="text-red-600 dark:text-red-400 px-3 py-2 rounded-md text-sm font-medium">
                        Uitleg
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Inloggen
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Hoe werkt het Veiligheidsnetwerk?
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Een innovatief systeem dat gebruik maakt van technologie om sociale controle te verbeteren en mensen veiliger te laten voelen in hun buurt.
            </p>
        </div>

        <!-- Mission Statement -->
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg p-8 mb-12">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-red-800 dark:text-red-200 mb-4">
                    Onze Missie
                </h2>
                <p class="text-red-700 dark:text-red-300 text-lg leading-relaxed">
                    Het Veiligheidsnetwerk is specifiek ontwikkeld om <strong>vrouwen te helpen zich veiliger te voelen op straat</strong> en om <strong>extra sociale controle toe te passen</strong> in buurten. We geloven dat technologie een krachtig middel kan zijn om gemeenschappen sterker en veiliger te maken.
                </p>
            </div>
        </div>

        <!-- How It Works -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">
                Hoe werkt het systeem?
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-red-500">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-red-600 dark:text-red-400 font-bold text-xl">1</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                            Registreer je locaties
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Voeg je belangrijke locaties toe zoals thuis, werk, of andere plekken waar je vaak bent. Het systeem gebruikt deze informatie om je te verbinden met mensen in je buurt.
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-red-500">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-red-600 dark:text-red-400 font-bold text-xl">2</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                            Stuur een noodmelding
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Als je je onveilig voelt, kun je met één druk op de knop een noodmelding versturen. Het systeem vindt automatisch mensen in je buurt die kunnen helpen.
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-red-500">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-red-600 dark:text-red-400 font-bold text-xl">3</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                            Krijg directe hulp
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Mensen binnen 5km van je locatie krijgen een melding en kunnen direct reageren om je te helpen. Het systeem past zich aan om ervoor te zorgen dat er altijd voldoende mensen bereikbaar zijn.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dynamic Range Explanation -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                Intelligente Range-aanpassing
            </h2>
            <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                Het systeem gebruikt een <strong>dynamische range</strong> om ervoor te zorgen dat er altijd voldoende mensen beschikbaar zijn om te helpen:
            </p>
            <ul class="space-y-3 text-gray-600 dark:text-gray-300">
                <li class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 mr-3 mt-1">•</span>
                    <span>Start met een bereik van <strong>1 kilometer</strong></span>
                </li>
                <li class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 mr-3 mt-1">•</span>
                    <span>Als er minder dan 20 mensen binnen bereik zijn, wordt het bereik uitgebreid</span>
                </li>
                <li class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 mr-3 mt-1">•</span>
                    <span>Het bereik kan oplopen tot maximaal <strong>5 kilometer</strong></span>
                </li>
                <li class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 mr-3 mt-1">•</span>
                    <span>Dit zorgt ervoor dat er altijd voldoende hulp beschikbaar is, ongeacht waar je bent</span>
                </li>
            </ul>
        </div>

        <!-- Why We Created This -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">
                Waarom hebben we dit gemaakt?
            </h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Women's Safety -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                Veiligheid voor vrouwen
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                Veel vrouwen voelen zich onveilig op straat, vooral 's avonds of in afgelegen gebieden. Dit systeem geeft hen een directe verbinding met mensen in hun buurt die kunnen helpen in geval van nood.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Social Control -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                Sociale controle
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                Door mensen in de buurt te betrekken bij de veiligheid van hun gemeenschap, creëren we een vorm van sociale controle die misdaad kan voorkomen en de leefbaarheid verbetert.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Technology for Good -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                Technologie voor het goede
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                We gebruiken moderne technologie om mensen te verbinden en gemeenschappen sterker te maken. Het systeem is eenvoudig te gebruiken maar krachtig in zijn effect.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Community Building -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                Gemeenschapsopbouw
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                Het systeem brengt mensen samen rond een gemeenschappelijk doel: veiligheid. Dit versterkt de banden in de buurt en creëert een gevoel van saamhorigheid.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Similar Concepts -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-8 mb-12">
            <h2 class="text-2xl font-bold text-blue-800 dark:text-blue-200 mb-6">
                Vergelijkbare concepten
            </h2>
            <p class="text-blue-700 dark:text-blue-300 mb-6 leading-relaxed">
                Ons concept is geïnspireerd door bestaande systemen die al succesvol zijn gebleken:
            </p>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                    Hartaanval-alert systemen
                </h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                    Er bestaan al systemen waarbij mensen die een hartaanval krijgen automatisch een melding sturen naar iedereen in de omgeving. Deze mensen krijgen dan een bericht om te komen helpen. Dit concept heeft al vele levens gered en toont aan dat technologie een krachtig middel kan zijn om mensen te verbinden in noodsituaties.
                </p>
            </div>
        </div>

        <!-- Privacy and Security -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                Privacy en veiligheid
            </h2>
            <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                We nemen de privacy en veiligheid van onze gebruikers zeer serieus:
            </p>
            <ul class="space-y-3 text-gray-600 dark:text-gray-300">
                <li class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 mr-3 mt-1">•</span>
                    <span><strong>Locatiegegevens</strong> worden alleen gebruikt voor het vinden van mensen in de buurt en worden niet permanent opgeslagen</span>
                </li>
                <li class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 mr-3 mt-1">•</span>
                    <span><strong>Persoonlijke informatie</strong> wordt alleen gedeeld met mensen die daadwerkelijk hulp bieden</span>
                </li>
                <li class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 mr-3 mt-1">•</span>
                    <span><strong>Noodmeldingen</strong> worden alleen verzonden wanneer je daar expliciet om vraagt</span>
                </li>
                <li class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 mr-3 mt-1">•</span>
                    <span><strong>Gegevens</strong> worden versleuteld opgeslagen en voldoen aan de AVG-richtlijnen</span>
                </li>
            </ul>
        </div>

        <!-- Call to Action -->
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                Doe mee met het Veiligheidsnetwerk
            </h2>
            <p class="text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
                Word onderdeel van een groeiende gemeenschap die zich inzet voor veiligheid en sociale controle. Samen kunnen we onze buurten veiliger maken.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                        Ga naar Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                        Registreer je gratis
                    </a>
                    <a href="{{ route('login') }}" class="inline-block bg-white hover:bg-gray-50 text-red-600 border-2 border-red-600 hover:border-red-700 px-8 py-3 rounded-lg font-medium transition-colors">
                        Inloggen
                    </a>
                @endauth
            </div>
        </div>

        <!-- Open Source Information -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-8 mt-12">
            <div class="text-center">
                <h3 class="font-mono text-xl font-semibold text-gray-900 dark:text-white mb-4">
                    Open Source Project
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Dit project is volledig open source. Bekijk de broncode, draag bij aan de ontwikkeling of leer meer over hoe het systeem werkt.
                </p>
                <a href="https://github.com/mathijso/ikvoelmeonveilig" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-2 bg-gray-900 dark:bg-white hover:bg-gray-800 dark:hover:bg-gray-100 text-white dark:text-gray-900 px-6 py-3 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Bekijk op GitHub</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="text-gray-600 dark:text-gray-300">
                    © 2024 Veiligheidsnetwerk. Gemaakt om gemeenschappen veiliger te maken.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
