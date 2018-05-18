<?php

namespace App\Http\Controllers\UserContext;

use App\Book;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        return BookResource::collection(Book::paginate());
    }

    public function show(Book $book)
    {
        return BookResource::make($book);
    }

}
