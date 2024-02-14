<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $episode = Episode::all();
        return response()->json($episode);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $episode = Episode::create($request->all());
        return response()->json($episode, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $episode = Episode::findOrFail($id);
        return response()->json($episode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $episode = Episode::findOrFail($id);
        $episode->update($request->all());
        return response()->json($episode, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Episode::findOrFail($id)->delete();
        return response()->json('Deleted Successfully', 200);
    }
}
