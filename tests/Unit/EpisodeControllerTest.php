<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Episode;

class EpisodeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test episode creation.
     *
     * @return void
     */
    public function testEpisodeCreation()
    {
        $response = $this->postJson('/api/episodes', [
            'name' => 'Test Episode',
            'air_date' => '2024-02-14',
            'episode' => 'S01E01',
            'url' => 'https://example.com/episode',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'air_date',
                'episode',
                'url',
                'created_at',
                'updated_at'
            ]);
    }

    /**
     * Test episode deletion.
     *
     * @return void
     */
    public function testEpisodeDeletion()
    {
        $episode = Episode::factory()->create();

        $response = $this->deleteJson('/api/episodes/' . $episode->id);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted Successfully'
            ]);

        $this->assertDatabaseMissing('episodes', ['id' => $episode->id]);
    }
}
