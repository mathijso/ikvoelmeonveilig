<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    📍 Mijn Locaties
                </h1>
                <p class="text-gray-600 dark:text-gray-300 mt-2">
                    Beheer je belangrijke locaties zoals thuis, werk en andere plekken
                </p>
            </div>
            <button 
                wire:click="showAddForm"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors"
            >
                + Locatie Toevoegen
            </button>
        </div>
    </div>

    <!-- Add/Edit Form -->
    @if($showForm)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">
                {{ $editingLocation ? 'Locatie Bewerken' : 'Nieuwe Locatie Toevoegen' }}
            </h2>
            
            <form wire:submit="save" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Naam *
                        </label>
                        <input 
                            type="text" 
                            id="name"
                            wire:model="name"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                            placeholder="Bijv. Thuis, Werk, Gym"
                        >
                        @error('name') 
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Adres
                        </label>
                        <input 
                            type="text" 
                            id="address"
                            wire:model="address"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                            placeholder="Straat, huisnummer, plaats"
                        >
                        @error('address') 
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Latitude -->
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Breedtegraad *
                        </label>
                        <input 
                            type="number" 
                            id="latitude"
                            wire:model="latitude"
                            step="any"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                            placeholder="52.3676"
                        >
                        @error('latitude') 
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Longitude -->
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Lengtegraad *
                        </label>
                        <input 
                            type="number" 
                            id="longitude"
                            wire:model="longitude"
                            step="any"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                            placeholder="4.9041"
                        >
                        @error('longitude') 
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Get Current Location Button -->
                <div class="flex justify-center">
                    <button 
                        type="button"
                        onclick="getCurrentLocation()"
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors"
                    >
                        📍 Huidige Locatie Ophalen
                    </button>
                </div>
                </div>

                <!-- Options -->
                <div class="flex items-center space-x-6">
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            wire:model="is_primary"
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        >
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Primaire locatie</span>
                    </label>
                    
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            wire:model="is_active"
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        >
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Actief</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <button 
                        type="button"
                        wire:click="cancel"
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                    >
                        Annuleren
                    </button>
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                    >
                        {{ $editingLocation ? 'Bijwerken' : 'Toevoegen' }}
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Locations List -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                Mijn Locaties ({{ $locations->total() }})
            </h2>
        </div>

        @if($locations->count() > 0)
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($locations as $location)
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    @if($location->is_primary)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            🏠 Primaire
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                            📍 Locatie
                                        </span>
                                    @endif
                                </div>
                                
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                        {{ $location->name }}
                                    </h3>
                                    @if($location->address)
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $location->address }}
                                        </p>
                                    @endif
                                    <p class="text-xs text-gray-400 dark:text-gray-500">
                                        {{ number_format($location->latitude, 6) }}, {{ number_format($location->longitude, 6) }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <!-- Toggle Primary -->
                                <button 
                                    wire:click="togglePrimary({{ $location->id }})"
                                    class="p-2 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors"
                                    title="{{ $location->is_primary ? 'Verwijder primaire status' : 'Maak primaire locatie' }}"
                                >
                                    @if($location->is_primary)
                                        🏠
                                    @else
                                        🏘️
                                    @endif
                                </button>

                                <!-- Toggle Active -->
                                <button 
                                    wire:click="toggleActive({{ $location->id }})"
                                    class="p-2 text-gray-400 hover:text-green-600 dark:hover:text-green-400 transition-colors"
                                    title="{{ $location->is_active ? 'Deactiveren' : 'Activeren' }}"
                                >
                                    @if($location->is_active)
                                        ✅
                                    @else
                                        ❌
                                    @endif
                                </button>

                                <!-- Edit -->
                                <button 
                                    wire:click="showEditForm({{ $location->id }})"
                                    class="p-2 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors"
                                    title="Bewerken"
                                >
                                    ✏️
                                </button>

                                <!-- Delete -->
                                <button 
                                    wire:click="delete({{ $location->id }})"
                                    wire:confirm="Weet je zeker dat je deze locatie wilt verwijderen?"
                                    class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                    title="Verwijderen"
                                >
                                    🗑️
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($locations->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $locations->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center">
                <span class="text-6xl mb-4 block">📍</span>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                    Nog geen locaties
                </h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">
                    Voeg je eerste locatie toe om te beginnen
                </p>
                <button 
                    wire:click="showAddForm"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors"
                >
                    + Locatie Toevoegen
                </button>
            </div>
        @endif
    </div>

    <!-- Flash Messages -->
    <div 
        x-data="{ show: false, message: '' }"
        x-on:location-created.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 3000)"
        x-on:location-updated.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 3000)"
        x-on:location-deleted.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 3000)"
        x-on:location-detected.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50"
    >
        <span x-text="message"></span>
    </div>

    <!-- JavaScript for getting current location -->
    <script>
        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        // Update the form fields with current location
                        @this.set('latitude', position.coords.latitude);
                        @this.set('longitude', position.coords.longitude);
                        
                        // Show success message
                        const event = new CustomEvent('location-detected', {
                            detail: { message: 'Huidige locatie opgehaald!' }
                        });
                        window.dispatchEvent(event);
                    },
                    function(error) {
                        // Show error message
                        alert('Kon je huidige locatie niet ophalen. Controleer je locatie-instellingen.');
                        console.error('Geolocation error:', error);
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 60000
                    }
                );
            } else {
                alert('Geolocatie wordt niet ondersteund door je browser.');
            }
        }
    </script>
</div>
