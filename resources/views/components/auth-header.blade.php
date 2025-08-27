@props([
    'title',
    'description',
    'purpose' => null,
])

<div class="flex w-full flex-col text-center">
    
    
    @if($purpose)
        <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
            <div class="text-sm text-blue-800 dark:text-blue-200">
                <div class="font-medium mb-2">Waarom heb je een account nodig?</div>
                <div class="space-y-2">
                    @if($purpose === 'melder')
                        <div class="flex items-start gap-2">
                            <span class="text-blue-600 dark:text-blue-400">•</span>
                            <span>Meldingen maken van onveilige situaties</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-blue-600 dark:text-blue-400">•</span>
                            <span>Je meldingen beheren en bijwerken</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-blue-600 dark:text-blue-400">•</span>
                            <span>Hulp krijgen van mensen in je buurt</span>
                        </div>
                    @elseif($purpose === 'helper')
                        <div class="flex items-start gap-2">
                            <span class="text-blue-600 dark:text-blue-400">•</span>
                            <span>Meldingen van onveilige situaties bekijken</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-blue-600 dark:text-blue-400">•</span>
                            <span>Hulp bieden aan mensen in nood</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-blue-600 dark:text-blue-400">•</span>
                            <span>Je buurt veiliger maken</span>
                        </div>
                    @else
                        <div class="flex items-start gap-2">
                            <span class="text-blue-600 dark:text-blue-400">•</span>
                            <span>Meldingen maken van onveilige situaties</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-blue-600 dark:text-blue-400">•</span>
                            <span>Hulp bieden aan mensen in nood</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-blue-600 dark:text-blue-400">•</span>
                            <span>Je buurt veiliger maken</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
