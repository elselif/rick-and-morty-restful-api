<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Character;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CharacterTest extends TestCase
{
    use RefreshDatabase;

    public function test_character_can_be_created()
    {
        $character = Character::factory()->create();

        $this->assertInstanceOf(Character::class, $character);
    }

    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
