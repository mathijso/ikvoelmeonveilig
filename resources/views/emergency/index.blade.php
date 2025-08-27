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
                        Ik Voel Me Onveilig
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

        <!-- Location Warning -->
        <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-700 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <span class="text-orange-600 dark:text-orange-400 text-lg mr-3 mt-1">⚠️</span>
                <div>
                    <h3 class="text-orange-800 dark:text-orange-200 font-medium mb-1">
                        Belangrijk: Controleer je locatie
                    </h3>
                    <p class="text-orange-700 dark:text-orange-300 text-sm">
                        Zorg ervoor dat je exacte fysieke locatie correct is voordat je een noodmelding verstuurt. 
                        Dit is cruciaal voor de hulpverlening. Je kunt je locatie aanpassen als deze niet klopt.
                    </p>
                </div>
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
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-green-600 dark:text-green-400 text-lg mr-3">✅</span>
                                <div>
                                    <p class="text-green-800 dark:text-green-200 font-medium">Locatie bevestigd</p>
                                    <p class="text-green-700 dark:text-green-300 text-sm" x-text="locationAddress"></p>
                                    <p class="text-green-600 dark:text-green-400 text-xs mt-1">
                                        Coördinaten: <span x-text="latitude + ', ' + longitude"></span>
                                    </p>
                                </div>
                            </div>
                            <button 
                                @click="showLocationForm = true"
                                class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-200 text-sm font-medium"
                            >
                                Locatie aanpassen
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Location Adjustment Form -->
                <div x-show="showLocationForm" x-cloak class="mb-6">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                        <h4 class="text-blue-800 dark:text-blue-200 font-medium mb-3">Controleer en pas je locatie aan</h4>
                        <p class="text-blue-700 dark:text-blue-300 text-sm mb-4">
                            Zorg ervoor dat dit je exacte fysieke locatie is. Dit is cruciaal voor de hulpverlening.
                        </p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-blue-800 dark:text-blue-200 mb-1">
                                    Breedtegraad
                                </label>
                                <input 
                                    type="number" 
                                    x-model="latitude" 
                                    step="any"
                                    class="w-full px-3 py-2 border border-blue-300 dark:border-blue-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-blue-800 dark:text-blue-200"
                                    placeholder="52.3676"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-800 dark:text-blue-200 mb-1">
                                    Lengtegraad
                                </label>
                                <input 
                                    type="number" 
                                    x-model="longitude" 
                                    step="any"
                                    class="w-full px-3 py-2 border border-blue-300 dark:border-blue-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-blue-800 dark:text-blue-200"
                                    placeholder="4.9041"
                                >
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-blue-800 dark:text-blue-200 mb-1">
                                Adres (optioneel)
                            </label>
                            <input 
                                type="text" 
                                x-model="locationAddress" 
                                class="w-full px-3 py-2 border border-blue-300 dark:border-blue-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-blue-800 dark:text-blue-200"
                                placeholder="Straat, huisnummer, plaats"
                            >
                        </div>
                        
                        <div class="flex space-x-3">
                            <button 
                                @click="getCurrentLocation()"
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors text-sm"
                            >
                                📍 Huidige locatie ophalen
                            </button>
                            <button 
                                @click="confirmLocation()"
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors text-sm"
                            >
                                ✅ Locatie bevestigen
                            </button>
                            <button 
                                @click="showLocationForm = false"
                                class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-lg transition-colors text-sm"
                            >
                                Annuleren
                            </button>
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

                <!-- Location Status Info -->
                <div class="mt-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-300">
                            <span x-show="locationConfirmed">✅ Locatie bevestigd</span>
                            <span x-show="!locationConfirmed">⏳ Locatie wordt opgehaald...</span>
                        </span>
                        <span class="text-gray-500 dark:text-gray-400" x-show="locationConfirmed">
                            Nauwkeurigheid: <span x-text="locationAccuracy || 'Hoog'"></span>
                        </span>
                    </div>
                </div>

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
                latitude: '',
                longitude: '',
                locationAccuracy: '',
                showLocationForm: false,
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
                                this.latitude = position.coords.latitude.toFixed(8);
                                this.longitude = position.coords.longitude.toFixed(8);
                                
                                // Set accuracy information
                                if (position.coords.accuracy) {
                                    if (position.coords.accuracy <= 10) {
                                        this.locationAccuracy = 'Zeer hoog';
                                    } else if (position.coords.accuracy <= 50) {
                                        this.locationAccuracy = 'Hoog';
                                    } else if (position.coords.accuracy <= 100) {
                                        this.locationAccuracy = 'Gemiddeld';
                                    } else {
                                        this.locationAccuracy = 'Laag';
                                    }
                                } else {
                                    this.locationAccuracy = 'Onbekend';
                                }
                                
                                this.getAddressFromCoords(position.coords.latitude, position.coords.longitude);
                                
                                // Show success message
                                this.showLocationMessage('Locatie succesvol opgehaald!');
                            },
                            (error) => {
                                console.error('Geolocation error:', error);
                                let errorMsg = 'Kon je locatie niet bepalen. ';
                                
                                switch(error.code) {
                                    case error.PERMISSION_DENIED:
                                        errorMsg += 'Locatie toegang geweigerd. Controleer je browser instellingen.';
                                        break;
                                    case error.POSITION_UNAVAILABLE:
                                        errorMsg += 'Locatie informatie niet beschikbaar.';
                                        break;
                                    case error.TIMEOUT:
                                        errorMsg += 'Locatie ophalen duurde te lang. Probeer het opnieuw.';
                                        break;
                                    default:
                                        errorMsg += 'Er is een onbekende fout opgetreden.';
                                }
                                
                                this.errorMessage = errorMsg;
                                this.showErrorModal = true;
                            },
                            {
                                enableHighAccuracy: true,
                                timeout: 15000,
                                maximumAge: 30000
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

                confirmLocation() {
                    // Validate coordinates
                    const lat = parseFloat(this.latitude);
                    const lng = parseFloat(this.longitude);
                    
                    if (isNaN(lat) || isNaN(lng)) {
                        alert('Voer geldige coördinaten in.');
                        return;
                    }
                    
                    if (lat < -90 || lat > 90) {
                        alert('Breedtegraad moet tussen -90 en 90 liggen.');
                        return;
                    }
                    
                    if (lng < -180 || lng > 180) {
                        alert('Lengtegraad moet tussen -180 en 180 liggen.');
                        return;
                    }
                    
                    // Update coordinates with proper precision
                    this.latitude = lat.toFixed(8);
                    this.longitude = lng.toFixed(8);
                    
                    // Get address for the new coordinates
                    this.getAddressFromCoords(lat, lng);
                    
                    // Hide the form and confirm location
                    this.showLocationForm = false;
                    this.locationConfirmed = true;
                    
                    // Show success message
                    this.showLocationMessage('Locatie succesvol bijgewerkt!');
                },

                showLocationMessage(message) {
                    // Create a temporary success message
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                    messageDiv.textContent = message;
                    document.body.appendChild(messageDiv);
                    
                    // Remove after 3 seconds
                    setTimeout(() => {
                        if (messageDiv.parentNode) {
                            messageDiv.parentNode.removeChild(messageDiv);
                        }
                    }, 3000);
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

