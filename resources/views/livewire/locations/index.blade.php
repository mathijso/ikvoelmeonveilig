<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Mijn Locaties
                </h1>
                <p class="text-gray-600 dark:text-gray-300 mt-2">
                    Beheer je belangrijke locaties zoals thuis, werk en andere plekken
                </p>
            </div>
            <button 
                wire:click="showAddForm"
                class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors"
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
                <!-- General Error Message -->
                @error('general')
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                        <p class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</p>
                    </div>
                @enderror

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
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                            placeholder="Bijv. Thuis, Werk, Gym"
                        >
                        @error('name') 
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Postcode -->
                    <div>
                        <label for="postcode" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Postcode {{ !$editingLocation ? '*' : '' }}
                        </label>
                        <div class="flex space-x-2">
                            <input 
                                type="text" 
                                id="postcode"
                                wire:model.live.debounce.500ms="postcode"
                                wire:change="lookupPostcode"
                                class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                placeholder="1234AB"
                                maxlength="6"
                                {{ $editingLocation ? 'disabled' : '' }}
                            >
                            <button 
                                type="button"
                                wire:click="lookupPostcode"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                                {{ $editingLocation ? 'disabled' : '' }}
                            >
                                Zoeken
                            </button>
                        </div>
                        @error('postcode') 
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ $editingLocation ? 'Postcode kan niet worden gewijzigd voor bestaande locaties' : 'Voer een Nederlandse postcode in om automatisch coördinaten op te halen' }}
                        </p>
                    </div>

                    <!-- Address (Read-only display) -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Adres
                        </label>
                        <div class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300">
                            {{ $address ?: 'Wordt automatisch ingevuld op basis van postcode' }}
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Adres wordt automatisch opgehaald op basis van de postcode
                        </p>
                    </div>

                    <!-- Coordinates Section (Read-only display) -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Locatie Gegevens</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Latitude -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Breedtegraad
                                </label>
                                <div class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300">
                                    {{ $latitude ? number_format((float)$latitude, 6) : 'Wordt automatisch ingevuld' }}
                                </div>
                            </div>

                            <!-- Longitude -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Lengtegraad
                                </label>
                                <div class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300">
                                    {{ $longitude ? number_format((float)$longitude, 6) : 'Wordt automatisch ingevuld' }}
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            Coördinaten worden automatisch opgehaald op basis van de postcode
                        </p>
                    </div>
                </div>

                <!-- Options -->
                <div class="flex items-center space-x-6">
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            wire:model="is_primary"
                            class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50"
                        >
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Primaire locatie</span>
                    </label>
                    
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            wire:model="is_active"
                            class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50"
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
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
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
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            Primaire
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                            Locatie
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
                                    class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                    title="{{ $location->is_primary ? 'Verwijder primaire status' : 'Maak primaire locatie' }}"
                                >
                                    @if($location->is_primary)
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                        </svg>
                                    @endif
                                </button>

                                <!-- Toggle Active -->
                                <button 
                                    wire:click="toggleActive({{ $location->id }})"
                                    class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                    title="{{ $location->is_active ? 'Deactiveren' : 'Activeren' }}"
                                >
                                    @if($location->is_active)
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </button>

                                <!-- Edit -->
                                <button 
                                    wire:click="showEditForm({{ $location->id }})"
                                    class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                    title="Bewerken"
                                >
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </button>

                                <!-- Delete -->
                                <button 
                                    wire:click="delete({{ $location->id }})"
                                    wire:confirm="Weet je zeker dat je deze locatie wilt verwijderen?"
                                    class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                    title="Verwijderen"
                                >
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
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
                <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                    Nog geen locaties
                </h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">
                    Voeg je eerste locatie toe om te beginnen
                </p>
                <button 
                    wire:click="showAddForm"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors"
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
        x-on:postcode-looked-up.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50"
    >
        <span x-text="message"></span>
    </div>
</div>
