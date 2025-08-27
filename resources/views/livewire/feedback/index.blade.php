<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Feedback Board
                </h1>
                <p class="text-gray-600 dark:text-gray-300 mt-2">
                    Help ons de wereld veiliger te maken! Deel je ideeën en stem op suggesties van anderen.
                </p>
                <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                    <p class="text-sm text-red-800 dark:text-red-200">
                        <strong>Gezamenlijke inspanning:</strong> Deze app is een gezamenlijke inspanning om de wereld veiliger te maken. 
                        Jouw feedback helpt ons om de functionaliteit te verbeteren en nieuwe features toe te voegen die écht het verschil maken.
                    </p>
                </div>
            </div>
            <button 
                wire:click="showAddForm"
                class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors"
            >
                + Feedback Indienen
            </button>
        </div>
    </div>

    <!-- Add Feedback Form -->
    @if($showForm)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">
                Nieuwe Feedback Indienen
            </h2>
            
            <form wire:submit="submitFeedback" class="space-y-6">
                <!-- General Error Message -->
                @error('general')
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                        <p class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</p>
                    </div>
                @enderror

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Titel *
                        </label>
                        <input 
                            type="text" 
                            id="title"
                            wire:model="title"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                            placeholder="Korte, duidelijke titel voor je feedback"
                        >
                        @error('title') 
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Categorie *
                        </label>
                        <select 
                            id="category"
                            wire:model="category"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                        >
                            <option value="feature">Nieuwe Feature</option>
                            <option value="improvement">Verbetering</option>
                            <option value="bug">Bug Report</option>
                            <option value="other">Overig</option>
                        </select>
                        @error('category') 
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Anonymous -->
                    <div class="flex items-center">
                        <label class="flex items-center">
                            <input 
                                type="checkbox" 
                                wire:model="is_anonymous"
                                class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50"
                            >
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Anoniem indienen</span>
                        </label>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Beschrijving *
                    </label>
                    <textarea 
                        id="description"
                        wire:model="description"
                        rows="6"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                        placeholder="Beschrijf je feedback in detail. Wat wil je voorstellen of verbeteren?"
                    ></textarea>
                    @error('description') 
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                        Feedback Indienen
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Filters and Sorting -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div class="flex flex-wrap items-center space-x-4">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Filter:</span>
                <button 
                    wire:click="setFilterCategory('')"
                    class="px-3 py-1 text-sm rounded-full transition-colors {{ empty($filterCategory) ? 'bg-red-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}"
                >
                    Alle
                </button>
                @foreach($categories as $key => $label)
                    <button 
                        wire:click="setFilterCategory('{{ $key }}')"
                        class="px-3 py-1 text-sm rounded-full transition-colors {{ $filterCategory === $key ? 'bg-red-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>
            
            <div class="flex items-center space-x-4">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Sorteren:</span>
                <button 
                    wire:click="setSortBy('score')"
                    class="px-3 py-1 text-sm rounded-full transition-colors {{ $sortBy === 'score' ? 'bg-red-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}"
                >
                    Populair
                </button>
                <button 
                    wire:click="setSortBy('recent')"
                    class="px-3 py-1 text-sm rounded-full transition-colors {{ $sortBy === 'recent' ? 'bg-red-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}"
                >
                    Recent
                </button>
            </div>
        </div>
    </div>

    <!-- Feedback List -->
    <div class="space-y-4">
        @if($feedback->count() > 0)
            @foreach($feedback as $item)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex space-x-4">
                        <!-- Voting -->
                        <div class="flex flex-col items-center space-y-2">
                            <button 
                                wire:click="vote({{ $item->id }}, 'upvote')"
                                class="p-2 rounded-lg transition-colors {{ isset($item->user_vote) && $item->user_vote === 'upvote' ? 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400' : 'text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                                title="Upvote"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $item->score }}
                            </span>
                            
                            <button 
                                wire:click="vote({{ $item->id }}, 'downvote')"
                                class="p-2 rounded-lg transition-colors {{ isset($item->user_vote) && $item->user_vote === 'downvote' ? 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400' : 'text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                                title="Downvote"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                    {{ $categories[$item->category] }}
                                </span>
                                @if($item->status !== 'open')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                    </span>
                                @endif
                            </div>
                            
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ $item->title }}
                            </h3>
                            
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                {{ $item->description }}
                            </p>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                                <div class="flex items-center space-x-4">
                                    <span>Door {{ $item->author_name }}</span>
                                    <span>{{ $item->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span>{{ $item->upvotes }} upvotes</span>
                                    <span>{{ $item->downvotes }} downvotes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            @if($feedback->hasPages())
                <div class="mt-8">
                    {{ $feedback->links() }}
                </div>
            @endif
        @else
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                    Nog geen feedback
                </h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">
                    Wees de eerste om feedback in te dienen!
                </p>
                <button 
                    wire:click="showAddForm"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors"
                >
                    + Feedback Indienen
                </button>
            </div>
        @endif
    </div>

    <!-- Flash Messages -->
    <div 
        x-data="{ show: false, message: '' }"
        x-on:feedback-submitted.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 3000)"
        x-on:vote-updated.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50"
    >
        <span x-text="message"></span>
    </div>
</div>
