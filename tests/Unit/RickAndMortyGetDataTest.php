<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
class RickAndMortyGetDataTest extends TestCase
{
    use RefreshDatabase;


    public function test_data_can_be_fetched_and_stored_successfully()
    {
        // ...

        Artisan::call('rickandmorty:getdata');

        $this->expectOutputString('Data has been fetched and stored successfully!');
    }


    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
