<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\SuggestedActivity;
use App\Http\Requests\StoreSuggestedActivityRequest;
use App\Http\Requests\UpdateSuggestedActivityRequest;
use App\Http\Resources\SuggestedActivityResource;

class SuggestedActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SuggestedActivityResource::collection(SuggestedActivity::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuggestedActivityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SuggestedActivity $suggestedActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuggestedActivity $suggestedActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuggestedActivityRequest $request, SuggestedActivity $suggestedActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuggestedActivity $suggestedActivity)
    {
        //
    }
}
