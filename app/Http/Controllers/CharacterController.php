<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Character::with(['origin', 'location'])->get();
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
                    'name' => $character->origin,
                    'url' => $character->origin,
                ],
                'location' => [
                    'name' => $character->locations,
                    'url' => $character->location,
                ],
                'image' => $character->image,
                'created' => $character->created_at,
            ];
            $formattedCharacters[] = $formattedCharacter;
        }

        $responseData = [
            'info' => [
                'count' => count($characters),
                'pages' => 1,
                'next' => null,
                'prev' => null,
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
        $character = Character::create($request->all());
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
    public function update(Request $request,$id)
    {
        $character = Character::findOrFail($id);
        $character->update($request->all());
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
