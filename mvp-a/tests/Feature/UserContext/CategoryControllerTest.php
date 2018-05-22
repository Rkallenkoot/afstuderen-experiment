<?php

namespace Tests\Feature\UserContext;

use App\Book;
use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

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

    /** @test */
    public function should_404_when_category_doenst_exist()
    {
        $this->json('GET', route('userContext.category.show', -1))
            ->assertStatus(404);
    }

    /** @test */
    public function should_list_child_categories()
    {
        $c = factory(Category::class)->create();
        $c->children()->saveMany(factory(Category::class, 5)->make());

        $this->json('GET', route('userContext.category.children', $c))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'image_url',
                    'children' => [
                        [],
                    ],
                ]
            ]);
    }

    /** @test */
    public function should_show_category_based_on_user_locale_dutch()
    {
        $user = factory(User::class)->create([
            'locale' => 'nl',
        ]);

        $category = factory(Category::class)->create();

        $res = $this->actingAs($user)
            ->json('GET', route('userContext.category.show', $category->id))
            ->assertStatus(200)
            ->json();

        $this->assertTrue(starts_with($res['data']['name'], 'nl:'));
    }

    /** @test */
    public function should_show_category_based_on_user_locale_english()
    {
        $user = factory(User::class)->create([
            'locale' => 'en',
        ]);

        $category = factory(Category::class)->create();

        $enRes = $this->actingAs($user)
            ->json('GET', route('userContext.category.show', $category->id))
            ->assertStatus(200)
            ->json();

        $this->assertTrue(starts_with($enRes['data']['name'], 'en:'));
    }

    /** @test */
    public function should_list_books_that_are_in_category()
    {
        $c = factory(Category::class)->create();
        $c->books()->saveMany(factory(Book::class, 20)->make());

        $this->json('GET', route('userContext.category.books', $c))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'books' => [
                        [
                            'id',
                            'title',
                            'description',
                        ]
                    ],
                ],
            ]);
    }

    /** @test */
    public function should_list_books_that_are_in_category_localized_dutch()
    {
        $user = factory(User::class)->create([
            'locale' => 'nl',
        ]);

        $c = factory(Category::class)->create();
        $c->children()->saveMany(factory(Category::class, 5)->make());
        $c->books()->saveMany(factory(Book::class, 20)->make());

        $res = $this->actingAs($user)
            ->json('GET', route('userContext.category.books', $c))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'books' => [
                        [
                            'id',
                            'title',
                            'description',
                        ]
                    ],
                ],
            ])->json();

        $this->assertTrue(starts_with($res['data']['name'], 'nl:'));
    }

    /** @test */
    public function should_list_books_that_are_in_category_localized_english()
    {
        $user = factory(User::class)->create([
            'locale' => 'en',
        ]);

        $c = factory(Category::class)->create();
        $c->books()->saveMany(factory(Book::class, 20)->make());

        $res = $this->actingAs($user)
            ->json('GET', route('userContext.category.books', $c))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'books' => [
                        [
                            'id',
                            'title',
                            'description',
                        ]
                    ],
                ],
            ])->json();

        $this->assertTrue(starts_with($res['data']['name'], 'en:'));
    }

}
