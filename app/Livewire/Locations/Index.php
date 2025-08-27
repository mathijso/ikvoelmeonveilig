<?php

namespace App\Livewire\Locations;

use App\Models\UserLocation;
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

    #[Validate('required|numeric|between:-90,90')]
    public string $latitude = '';

    #[Validate('required|numeric|between:-180,180')]
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
        $this->validate();

        // If this is a primary location, unset other primary locations
        if ($this->is_primary) {
            \Illuminate\Support\Facades\Auth::user()->locations()->update(['is_primary' => false]);
        }

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
