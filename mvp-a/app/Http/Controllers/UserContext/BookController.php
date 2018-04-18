<?php

namespace App\Http\Controllers\UserContext;

use App\Book;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        return BookResource::collection($category->books()->paginate(20));
    }

}
