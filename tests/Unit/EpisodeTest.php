<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Episode;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EpisodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_episode_can_be_created()
    {
        $episode = Episode::factory()->create();

        $this->assertInstanceOf(Episode::class, $episode);
    }
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
