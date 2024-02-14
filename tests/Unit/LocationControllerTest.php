<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Location;

class LocationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test location creation.
     *
     * @return void
     */
    public function testLocationCreation()
    {
        $response = $this->postJson('/api/locations', [
            'name' => 'Test Location',
            'type' => 'Test Type',
            'dimension' => 'Test Dimension',
            'url' => 'https://example.com/location',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'type',
                'dimension',
                'url',
                'created_at',
                'updated_at'
            ]);
    }

    /**
     * Test location deletion.
     *
     * @return void
     */
    public function testLocationDeletion()
    {
        $location = Location::factory()->create();

        $response = $this->deleteJson('/api/locations/' . $location->id);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted Successfully'
            ]);

        $this->assertDatabaseMissing('locations', ['id' => $location->id]);
    }
}
