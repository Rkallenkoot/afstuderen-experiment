<?php

namespace App\Http\Controllers\UserContext;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function books(Category $category)
    {
        $category->load('books');
        return CategoryResource::make($category);
    }

    public function children(Category $category)
    {
        $category->load('children');
        return CategoryResource::make($category);
    }


}
