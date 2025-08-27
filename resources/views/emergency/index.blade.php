<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Noodmelding - Ik Voel Me Onveilig</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-red-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 min-h-screen" x-data="emergencyAlert()">
    <!-- Navigation -->
    <nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-red-600 dark:text-red-400">
                        🛡️ Ik Voel Me Onveilig
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium">
                            Uitloggen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-md mx-auto px-4 py-8">
        <!-- Status Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">✅</span>
                </div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                    Je bent beschermd
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm">
                    {{ Auth::user()->name }}, je hebt toegang tot het veiligheidsnetwerk
                </p>
            </div>
        </div>

        <!-- Emergency Button -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
            <div class="text-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Noodmelding Sturen
                </h3>
                
                <!-- Location Status -->
                <div x-show="!locationConfirmed" class="mb-6">
                    <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-700 rounded-lg p-4">
                        <div class="flex items-center">
                            <span class="text-yellow-600 dark:text-yellow-400 text-lg mr-3">📍</span>
                            <div>
                                <p class="text-yellow-800 dark:text-yellow-200 font-medium">Locatie nodig</p>
                                <p class="text-yellow-700 dark:text-yellow-300 text-sm">We hebben je locatie nodig om mensen in de buurt te waarschuwen</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="locationConfirmed" class="mb-6">
                    <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg p-4">
                        <div class="flex items-center">
                            <span class="text-green-600 dark:text-green-400 text-lg mr-3">✅</span>
                            <div>
                                <p class="text-green-800 dark:text-green-200 font-medium">Locatie bevestigd</p>
                                <p class="text-green-700 dark:text-green-300 text-sm" x-text="locationAddress"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Button -->
                <button 
                    @click="sendEmergencyAlert()"
                    :disabled="!locationConfirmed || isSending"
                    class="w-full bg-red-600 hover:bg-red-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white text-xl font-bold py-6 px-8 rounded-lg transition-colors shadow-lg hover:shadow-xl disabled:shadow-none"
                >
                    <div x-show="!isSending">
                        🚨 Ik Voel Me Onveilig
                    </div>
                    <div x-show="isSending" class="flex items-center justify-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Noodmelding verzenden...
                    </div>
                </button>

                <!-- Warning -->
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">
                    ⚠️ Gebruik deze functie alleen in echte noodsituaties. Voor directe hulp bel 112.
                </p>
            </div>
        </div>

        <!-- Instructions -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                Wat gebeurt er na je melding?
            </h3>
            <div class="space-y-3">
                <div class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 text-lg mr-3 mt-1">1</span>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                        Mensen binnen 3km van je locatie krijgen een melding
                    </p>
                </div>
                <div class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 text-lg mr-3 mt-1">2</span>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                        Ze kunnen je helpen of 112 bellen als dat nodig is
                    </p>
                </div>
                <div class="flex items-start">
                    <span class="text-red-600 dark:text-red-400 text-lg mr-3 mt-1">3</span>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                        Je kunt je melding annuleren als de situatie is opgelost
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div x-show="showSuccessModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-sm w-full">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">✅</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                    Noodmelding verzonden!
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4" x-text="successMessage"></p>
                <div class="flex space-x-3">
                    <button @click="showSuccessModal = false" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-lg transition-colors">
                        Sluiten
                    </button>
                    <a href="tel:112" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors">
                        Bel 112
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div x-show="showErrorModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-sm w-full">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">❌</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                    Fout opgetreden
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4" x-text="errorMessage"></p>
                <button @click="showErrorModal = false" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-lg transition-colors">
                    Sluiten
                </button>
            </div>
        </div>
    </div>

    <script>
        function emergencyAlert() {
            return {
                locationConfirmed: false,
                locationAddress: '',
                isSending: false,
                showSuccessModal: false,
                showErrorModal: false,
                successMessage: '',
                errorMessage: '',

                init() {
                    this.getLocation();
                },

                getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            (position) => {
                                this.locationConfirmed = true;
                                this.latitude = position.coords.latitude;
                                this.longitude = position.coords.longitude;
                                this.getAddressFromCoords(position.coords.latitude, position.coords.longitude);
                            },
                            (error) => {
                                console.error('Geolocation error:', error);
                                this.errorMessage = 'Kon je locatie niet bepalen. Controleer je locatie-instellingen.';
                                this.showErrorModal = true;
                            },
                            {
                                enableHighAccuracy: true,
                                timeout: 10000,
                                maximumAge: 60000
                            }
                        );
                    } else {
                        this.errorMessage = 'Geolocatie wordt niet ondersteund door je browser.';
                        this.showErrorModal = true;
                    }
                },

                async getAddressFromCoords(lat, lng) {
                    try {
                        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`);
                        const data = await response.json();
                        this.locationAddress = data.display_name || `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                    } catch (error) {
                        this.locationAddress = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                    }
                },

                async sendEmergencyAlert() {
                    if (!this.locationConfirmed) {
                        this.errorMessage = 'Locatie is nog niet bevestigd.';
                        this.showErrorModal = true;
                        return;
                    }

                    this.isSending = true;

                    try {
                        const response = await fetch('{{ route("emergency.store") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                latitude: this.latitude,
                                longitude: this.longitude,
                                address: this.locationAddress
                            })
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.successMessage = data.message;
                            this.showSuccessModal = true;
                        } else {
                            this.errorMessage = data.message;
                            this.showErrorModal = true;
                        }
                    } catch (error) {
                        console.error('Error sending emergency alert:', error);
                        this.errorMessage = 'Er is een fout opgetreden bij het verzenden van de noodmelding.';
                        this.showErrorModal = true;
                    } finally {
                        this.isSending = false;
                    }
                }
            }
        }
    </script>
</body>
</html>

