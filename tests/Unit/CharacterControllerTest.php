<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Character;

class CharacterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test character creation.
     *
     * @return void
     */
    public function testCharacterCreation()
    {
        $response = $this->postJson('/api/characters', [
            'name' => 'Test Character',
            'status' => 'Alive',
            'species' => 'Human',
            'type' => 'Test Type',
            'gender' => 'Male',
            'origin' => [
                'name' => 'Test Origin'
            ],
            'location' => [
                'name' => 'Test Location'
            ],
            'image' => 'https://example.com/image.jpg'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'status',
                'species',
                'type',
                'gender',
                'origin',
                'location',
                'image',
                'created_at',
                'updated_at'
            ]);
    }

    /**
     * Test character deletion.
     *
     * @return void
     */
    public function testCharacterDeletion()
    {
        $character = Character::factory()->create();

        $response = $this->deleteJson('/api/characters/' . $character->id);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted Successfully'
            ]);

        $this->assertDatabaseMissing('characters', ['id' => $character->id]);
    }
}
