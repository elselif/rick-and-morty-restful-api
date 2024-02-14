<?php

namespace App\Console\Commands;

use App\Models\Character;
use App\Models\Episode;
use App\Models\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RickAndMortyGetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

     protected $signature = 'rickandmorty:getdata';
    /**
     * The console command description.
     *
     * @var string
     */


    protected $description = 'Fetch data from Rick and Morty API and store in database';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $responseCharacter = Http::get('https://rickandmortyapi.com/api/character');
        $responseEpisode = Http::get('https://rickandmortyapi.com/api/episode');
        $responseLocation = Http::get('https://rickandmortyapi.com/api/location');

        if ($responseCharacter->successful()) {
            $data = $responseCharacter->json()['results'];

            foreach ($data as $item) {

                $character = Character::updateOrCreate(
                    ['id' => $item['id']],
                    [
                        'name' => $item['name'],
                        'status' => $item['status'],
                        'species' => $item['species'],
                        'type' => isset($item['type']) ? $item['type'] : null,
                        'gender' => $item['gender'],
                        'image' => $item['image'],
                    ]
                );


                $location = Location::where('name', $item['location']['name'])->first();
                if (!$location) {
                    $location = new Location();
                    $location->name = $item['location']['name'];
                    $location->save();
                }


                $origin = Location::where('name', $item['origin']['name'])->first();
                if (!$origin) {
                    $origin = new Location();
                    $origin->name = $item['origin']['name'];
                    $origin->save();
                }


                $character->location_id = $location->id;
                $character->origin_id = $origin->id;
                $character->save();
            }


            $this->info('Data has been fetched and stored successfully!');
        } else {
            $this->error('Failed to fetch data from API!');
        }

        if ($responseEpisode->successful()) {
            $data = $responseEpisode->json()['results'];

            foreach ($data as $item) {

                Episode::updateOrCreate(
                    ['id' => $item['id']],
                    [
                        'name' => $item['name'],
                        'air_date' => $item['air_date'],
                        'episode' => $item['episode'],
                        'url' => $item['url'],
                    ]
                );
            }

            $this->info('Data has been fetched and stored successfully!');
        } else {
            $this->error('Failed to fetch data from API!');
        }

        if ($responseLocation->successful()) {
            $data = $responseLocation->json()['results'];

            foreach ($data as $item) {

                Location::updateOrCreate(
                    ['id' => $item['id']], 
                    [
                        'name' => $item['name'],
                        'type' => $item['type'],
                        'dimension' => $item['dimension'],
                        'url' => $item['url'],
                    ]
                );
            }
        $this->info('Data has been fetched and stored successfully!');
        } else {
            $this->error('Failed to fetch data from API!');
        }
    }




}
