<?php

namespace App\Livewire\Locations;

use App\Models\UserLocation;
use App\Services\PostcodeService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string|max:255')]
    public string $address = '';

    #[Validate('nullable|string|max:10')]
    public string $postcode = '';

    #[Validate('nullable|numeric|between:-90,90')]
    public string $latitude = '';

    #[Validate('nullable|numeric|between:-180,180')]
    public string $longitude = '';

    public bool $is_primary = false;
    public bool $is_active = true;
    public bool $showForm = false;
    public ?UserLocation $editingLocation = null;

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->address = '';
        $this->postcode = '';
        $this->latitude = '';
        $this->longitude = '';
        $this->is_primary = false;
        $this->is_active = true;
        $this->editingLocation = null;
        $this->showForm = false;
    }

    public function showAddForm()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function showEditForm(UserLocation $location)
    {
        $this->editingLocation = $location;
        $this->name = $location->name;
        $this->address = $location->address ?? '';
        $this->postcode = '';
        $this->latitude = (string) $location->latitude;
        $this->longitude = (string) $location->longitude;
        $this->is_primary = $location->is_primary;
        $this->is_active = $location->is_active;
        $this->showForm = true;
    }

    public function cancel()
    {
        $this->resetForm();
    }

    public function save()
    {
        // Validate required fields
        $this->validate([
            'name' => 'required|string|max:255',
            'postcode' => 'nullable|string|max:10',
        ]);

        // For new locations, postcode is required
        if (!$this->editingLocation && empty($this->postcode)) {
            $this->addError('postcode', 'Vul een postcode in voor de nieuwe locatie.');
            return;
        }

        // If postcode is provided, get coordinates
        if (!empty($this->postcode)) {
            $postcodeService = new PostcodeService();
            
            if (!$postcodeService->isValidDutchPostcode($this->postcode)) {
                $this->addError('postcode', 'Voer een geldige Nederlandse postcode in (bijv. 1234AB).');
                return;
            }

            $coordinates = $postcodeService->getCoordinatesForPostcode($this->postcode);
            
            if (!$coordinates) {
                $this->addError('postcode', 'Kon geen coördinaten vinden voor deze postcode. Controleer of de postcode correct is.');
                return;
            }

            $this->latitude = (string) $coordinates['latitude'];
            $this->longitude = (string) $coordinates['longitude'];
            
            // Update address if not provided
            if (empty($this->address) && isset($coordinates['address'])) {
                $this->address = $coordinates['address'];
            }
        }

        // Validate coordinates are present
        if (empty($this->latitude) || empty($this->longitude)) {
            $this->addError('latitude', 'Coördinaten zijn vereist. Vul een geldige postcode in.');
            return;
        }

        // If this is a primary location, unset other primary locations
        if ($this->is_primary) {
            \Illuminate\Support\Facades\Auth::user()->locations()->update(['is_primary' => false]);
        }

        try {
            if ($this->editingLocation) {
                // Update existing location
                $this->editingLocation->update([
                    'name' => $this->name,
                    'address' => $this->address,
                    'latitude' => $this->latitude,
                    'longitude' => $this->longitude,
                    'is_primary' => $this->is_primary,
                    'is_active' => $this->is_active,
                ]);
                
                $this->dispatch('location-updated', message: 'Locatie succesvol bijgewerkt!');
            } else {
                // Create new location
                \Illuminate\Support\Facades\Auth::user()->locations()->create([
                    'name' => $this->name,
                    'address' => $this->address,
                    'latitude' => $this->latitude,
                    'longitude' => $this->longitude,
                    'is_primary' => $this->is_primary,
                    'is_active' => $this->is_active,
                ]);
                
                $this->dispatch('location-created', message: 'Locatie succesvol toegevoegd!');
            }

            $this->resetForm();
        } catch (\Exception $e) {
            $this->addError('general', 'Er is een fout opgetreden bij het opslaan van de locatie. Probeer het opnieuw.');
        }
    }

    public function delete(UserLocation $location)
    {
        $location->delete();
        $this->dispatch('location-deleted', message: 'Locatie succesvol verwijderd!');
    }

    public function togglePrimary(UserLocation $location)
    {
        // Unset other primary locations
        \Illuminate\Support\Facades\Auth::user()->locations()->where('id', '!=', $location->id)->update(['is_primary' => false]);
        
        // Toggle this location's primary status
        $location->update(['is_primary' => !$location->is_primary]);
        
        $this->dispatch('location-updated', message: 'Primaire locatie bijgewerkt!');
    }

    public function toggleActive(UserLocation $location)
    {
        $location->update(['is_active' => !$location->is_active]);
        
        $this->dispatch('location-updated', message: 'Locatie status bijgewerkt!');
    }

    public function getCurrentLocation()
    {
        if (request()->hasHeader('X-Latitude') && request()->hasHeader('X-Longitude')) {
            $this->latitude = request()->header('X-Latitude');
            $this->longitude = request()->header('X-Longitude');
            $this->dispatch('location-detected');
        }
    }

    public function lookupPostcode()
    {
        if (empty($this->postcode)) {
            $this->addError('postcode', 'Voer een postcode in.');
            return;
        }

        $postcodeService = new PostcodeService();
        
        if (!$postcodeService->isValidDutchPostcode($this->postcode)) {
            $this->addError('postcode', 'Voer een geldige Nederlandse postcode in (bijv. 1234AB).');
            return;
        }

        $coordinates = $postcodeService->getCoordinatesForPostcode($this->postcode);
        
        if (!$coordinates) {
            $this->addError('postcode', 'Kon geen coördinaten vinden voor deze postcode. Controleer of de postcode correct is.');
            return;
        }

        $this->latitude = (string) $coordinates['latitude'];
        $this->longitude = (string) $coordinates['longitude'];
        
        // Update address if not provided
        if (empty($this->address) && isset($coordinates['address'])) {
            $this->address = $coordinates['address'];
        }

        $this->dispatch('postcode-looked-up', message: 'Postcode gevonden! Locatie gegevens zijn ingevuld.');
    }

    public function render()
    {
        $locations = \Illuminate\Support\Facades\Auth::user()->locations()
            ->orderBy('is_primary', 'desc')
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.locations.index', [
            'locations' => $locations
        ]);
    }
}
