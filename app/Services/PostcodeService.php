<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PostcodeService
{
    /**
     * Get coordinates for a Dutch postcode
     * 
     * @param string $postcode Dutch postcode (e.g., "1234AB")
     * @return array|null Array with latitude and longitude, or null if not found
     */
    public function getCoordinatesForPostcode(string $postcode): ?array
    {
        // Clean the postcode (remove spaces, make uppercase)
        $postcode = strtoupper(str_replace(' ', '', $postcode));
        
        // Validate Dutch postcode format (4 digits + 2 letters)
        if (!preg_match('/^[1-9][0-9]{3}[A-Z]{2}$/', $postcode)) {
            return null;
        }

        try {
            // Use OpenCage Geocoding API (free tier available)
            $response = Http::get("https://api.opencagedata.com/geocode/v1/json", [
                'q' => $postcode . ', Netherlands',
                'key' => config('services.opencage.key', 'demo'),
                'countrycode' => 'nl',
                'limit' => 1,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['results'][0])) {
                    $result = $data['results'][0];
                    
                    return [
                        'latitude' => $result['geometry']['lat'],
                        'longitude' => $result['geometry']['lng'],
                        'address' => $result['formatted'],
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::error('OpenCage API error: ' . $e->getMessage(), [
                'postcode' => $postcode
            ]);
        }

        // Fallback: try alternative API (Nominatim - OpenStreetMap)
        return $this->getCoordinatesFromNominatim($postcode);
    }

    /**
     * Fallback method using Nominatim (OpenStreetMap)
     */
    private function getCoordinatesFromNominatim(string $postcode): ?array
    {
        try {
            $response = Http::get("https://nominatim.openstreetmap.org/search", [
                'q' => $postcode . ', Netherlands',
                'format' => 'json',
                'limit' => 1,
                'countrycodes' => 'nl',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data[0])) {
                    $result = $data[0];
                    
                    return [
                        'latitude' => $result['lat'],
                        'longitude' => $result['lon'],
                        'address' => $result['display_name'],
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::error('Nominatim API error: ' . $e->getMessage(), [
                'postcode' => $postcode
            ]);
        }

        return null;
    }

    /**
     * Validate if a string is a valid Dutch postcode
     */
    public function isValidDutchPostcode(string $postcode): bool
    {
        $postcode = strtoupper(str_replace(' ', '', $postcode));
        return preg_match('/^[1-9][0-9]{3}[A-Z]{2}$/', $postcode);
    }
}
