<?php

namespace App\Http\Controllers\UserContext;

use App\Http\Resources\PublisherResource;
use App\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PublisherResource::collect(Publisher::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        return new PublisherResource($publisher);
    }

}
