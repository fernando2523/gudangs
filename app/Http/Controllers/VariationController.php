<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorevariationRequest;
use App\Http\Requests\UpdatevariationRequest;
use App\Models\variation;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorevariationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorevariationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function show(variation $variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function edit(variation $variation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatevariationRequest  $request
     * @param  \App\Models\variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatevariationRequest $request, variation $variation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function destroy(variation $variation)
    {
        //
    }
}
