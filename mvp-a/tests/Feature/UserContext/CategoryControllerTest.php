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
        $categories = factory(Category::class, 15)->states('parent')->create();

        $this->json(route('category.index'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'parent_id',
                    ],
                ],
                'meta' => [
                    'pagination' => []
                ]
            ]);
    }

    public function should_show_category()
    {
        $category = factory(Category::class)->create();

        $this->json('GET', route('category.show', $category))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'parent_id',
                    'image_url',
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
