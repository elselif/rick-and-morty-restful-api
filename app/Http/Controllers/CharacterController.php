<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Location;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Her sayfada gösterilecek karakter sayısı, varsayılan olarak 10
        $characters = Character::with(['origin', 'location'])->paginate($perPage); // Sayfalama için paginate kullanıyoruz


        $formattedCharacters = [];
        foreach ($characters as $character) {
            $formattedCharacter = [
                'id' => $character->id,
                'name' => $character->name,
                'status' => $character->status,
                'species' => $character->species,
                'type' => $character->type,
                'gender' => $character->gender,
                'origin' => [
                    'name' => $character->origin_id ? Location::find($character->origin_id)->name : null,
                    'url' => $character->origin_id ? Location::find($character->origin_id)->url : null,
                ],
                'location' => [
                    'name' => $character->location_id ? Location::find($character->location_id)->name : null,
                    'url' => $character->location_id ? Location::find($character->location_id)->url : null,
                ],
                'image' => $character->image,
                'created' => $character->created_at,
            ];
            $formattedCharacters[] = $formattedCharacter;
        }

        $responseData = [
            'info' => [
                'count' => $characters->total(), // Toplam karakter sayısı
                'pages' => $characters->lastPage(), // Toplam sayfa sayısı
                'next' => $characters->nextPageUrl(), // Bir sonraki sayfanın URL'si
                'prev' => $characters->previousPageUrl(), // Bir önceki sayfanın URL'si
            ],
            'results' => $formattedCharacters,
        ];

        return response()->json($responseData);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{

    $character = new Character();


    $character->name = $request->input('name');
    $character->status = $request->input('status');
    $character->species = $request->input('species');
    $character->type = $request->input('type', '');
    $character->gender = $request->input('gender');


    $originName = $request->input('origin.name');
    $locationName = $request->input('location.name');
    $origin = Location::where('type', $originName)->first();
    $location = Location::where('name', $locationName)->first();


    $character->origin()->associate($origin);
    $character->location()->associate($location);

    $character->image = $request->input('image');


    $character->save();


    return response()->json($character, 201);
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $character = Character::findOrFail($id);
        return response()->json($character);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $character = Character::findOrFail($id);


        $character->update($request->only(['name', 'status', 'species', 'type', 'gender', 'origin', 'location', 'image']));


        return response()->json($character, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Character::findOrFail($id)->delete();
        return response()->json('Deleted Successfully', 200);
    }
}
