<?php

namespace Tests\Feature;

use App\Services\PostcodeService;
use Tests\TestCase;

class PostcodeServiceTest extends TestCase
{
    private PostcodeService $postcodeService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postcodeService = new PostcodeService();
    }

    public function test_validates_dutch_postcode_format()
    {
        // Valid postcodes
        $this->assertTrue($this->postcodeService->isValidDutchPostcode('1234AB'));
        $this->assertTrue($this->postcodeService->isValidDutchPostcode('9999ZZ'));
        $this->assertTrue($this->postcodeService->isValidDutchPostcode('1234 ab')); // With spaces
        
        // Invalid postcodes
        $this->assertFalse($this->postcodeService->isValidDutchPostcode('123AB')); // Too short
        $this->assertFalse($this->postcodeService->isValidDutchPostcode('12345AB')); // Too long
        $this->assertFalse($this->postcodeService->isValidDutchPostcode('0234AB')); // Starts with 0
        $this->assertFalse($this->postcodeService->isValidDutchPostcode('1234A')); // Missing letter
        $this->assertFalse($this->postcodeService->isValidDutchPostcode('1234A1')); // Number instead of letter
    }

    public function test_gets_coordinates_for_valid_postcode()
    {
        // Test with a known Dutch postcode (Amsterdam Centraal)
        $coordinates = $this->postcodeService->getCoordinatesForPostcode('1011AB');
        
        if ($coordinates) {
            $this->assertArrayHasKey('latitude', $coordinates);
            $this->assertArrayHasKey('longitude', $coordinates);
            $this->assertArrayHasKey('address', $coordinates);
            
            // Amsterdam should be around 52.37, 4.90
            $this->assertGreaterThan(52.0, $coordinates['latitude']);
            $this->assertLessThan(53.0, $coordinates['latitude']);
            $this->assertGreaterThan(4.0, $coordinates['longitude']);
            $this->assertLessThan(5.0, $coordinates['longitude']);
        } else {
            // If API is not available, test should still pass
            $this->markTestSkipped('Postcode API not available');
        }
    }

    public function test_returns_null_for_invalid_postcode()
    {
        $coordinates = $this->postcodeService->getCoordinatesForPostcode('INVALID');
        $this->assertNull($coordinates);
    }
}
