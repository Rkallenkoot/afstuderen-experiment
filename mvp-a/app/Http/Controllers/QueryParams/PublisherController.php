<?php

namespace App\Http\Controllers\QueryParams;

use App\Http\Controllers\Controller;
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
        return PublisherResource::collection(Publisher::paginate(20));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        return PublisherResource::make($publisher);
    }

}
