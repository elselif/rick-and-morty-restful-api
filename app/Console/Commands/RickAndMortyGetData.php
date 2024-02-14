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
                // Verileri alarak veritabanına kaydedin
                Character::updateOrCreate(
                    ['id' => $item['id']], // Eğer karakter zaten varsa güncelle, yoksa oluştur
                    [
                        'name' => $item['name'],
                        'status' => $item['status'],
                        'species' => $item['species'],
                        'type' => $item['type'],
                        'gender' => $item['gender'],
                        'origin' => $item['origin']['name'],
                        'location' => $item['location']['name'],
                        'image' => $item['image'],
                    ]
                );


            }

            $this->info('Data has been fetched and stored successfully!');
        } else {
            $this->error('Failed to fetch data from API!');
        }

        if ($responseEpisode->successful()) {
            $data = $responseEpisode->json()['results'];

            foreach ($data as $item) {
                // Verileri alarak veritabanına kaydedin
                Episode::updateOrCreate(
                    ['id' => $item['id']], // Eğer bölüm zaten varsa güncelle, yoksa oluştur
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
                // Verileri alarak veritabanına kaydedin
                Location::updateOrCreate(
                    ['id' => $item['id']], // Eğer konum zaten varsa güncelle, yoksa oluştur
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
