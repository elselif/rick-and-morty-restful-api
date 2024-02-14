<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationTest extends TestCase
{

    use RefreshDatabase;

    public function test_location_can_be_created()
    {
        $location = Location::factory()->create();

        $this->assertInstanceOf(Location::class, $location);
    }
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
