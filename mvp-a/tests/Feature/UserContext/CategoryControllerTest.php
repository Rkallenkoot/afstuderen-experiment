<?php

namespace Tests\Feature\UserContext;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /** @test */
    public function should_list_parent_categories()
    {
        $categories = factory(Category::class, 15)->create();
        $categories->each(function($c) {
            $c->children()->saveMany(factory(Category::class,5)->make());
        });

        $this->json('GET', route('userContext.category.index'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'links' => [
                            'children',
                            'books',
                        ],
                    ],
                ],
                'links' => [
                ],
                'meta' => [
                    'current_page',
                    'last_page',
                    'from',
                    'to',
                    'path',
                    'per_page',
                    'total',
                ]
            ]);
    }

    /** @test */
    public function should_show_category()
    {
        $category = factory(Category::class)->create();

        $res = $this->json('GET', route('userContext.category.show', $category->id))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'image_url',
                    'links' => [
                        'children',
                        'books',
                    ],
                ],
            ]);
    }

    public function should_404_when_category_doenst_exist()
    {

    }

    public function should_list_child_categories()
    {

    }

    public function should_list_books_that_are_in_category()
    {

    }

}
