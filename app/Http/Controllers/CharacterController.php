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
        $characters = Character::all();
        return response()->json($characters);
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
