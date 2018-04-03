<?php

namespace Tests\Unit;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CategoryTest extends TestCase
{

    /** @test */
    public function should_be_instantiable()
    {
        $category = new Category;

        $this->assertNotNull($category);
    }

    /** @test */
    public function should_have_books_relationship()
    {
        $category = new Category;

        $this->assertInstanceOf(BelongsToMany::class, $category->books());
    }


    /** @test */
    public function should_have_parent_relationship()
    {
        $category = new Category;

        $this->assertInstanceOf(BelongsTo::class, $category->parent());
    }


    /** @test */
    public function should_have_children_relationship()
    {
        $category = new Category;

        $this->assertInstanceOf(HasMany::class, $category->children());
    }
}
