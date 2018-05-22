<?php

namespace Tests\Feature\UserContext;

use App\Book;
use App\Publisher;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublisherControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_should_return_publishers()
    {
        factory(Publisher::class, 15)->create();

        $this->json('GET', route('userContext.publisher.index'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'links' => [
                            'books',
                        ],
                    ],
                ],
                'meta' => [
                ]
            ]);
    }

    /** @test */
    public function show_should_return_single_publisher()
    {
        $p = factory(Publisher::class)->create();

        $this->json('GET', route('userContext.publisher.show', $p))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'links' => [
                        'books',
                    ],
                ],
            ]);
    }

    /** @test */
    public function should_return_publisher_books()
    {
        $p = factory(Publisher::class)->create();
        $p->books()->saveMany(factory(Book::class, 20)->make());

        $this->json('GET', route('userContext.publisher.books', $p))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'books' => [
                        ['id'],
                    ],
                ],
            ]);
    }

    /** @test */
    public function should_return_publisher_books_localized_dutch()
    {
        $user = factory(User::class)->create([
            'locale' => 'nl',
        ]);

        $p = factory(Publisher::class)->create();
        $p->books()->saveMany(factory(Book::class, 20)->make());

        $res = $this->actingAs($user)
            ->json('GET', route('userContext.publisher.books', [
                'publisher' => $p,
            ]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'books' => [
                        ['id','title','description'],
                    ],
                ],
            ])->json();

        $this->assertTrue(starts_with($res['data']['books'][0]['title'], 'nl:'));
        $this->assertTrue(starts_with($res['data']['books'][0]['description'], 'nl:'));
    }

    /** @test */
    public function should_return_publisher_books_localized_english()
    {
        $user = factory(User::class)->create([
            'locale' => 'en',
        ]);

        $p = factory(Publisher::class)->create();
        $p->books()->saveMany(factory(Book::class, 20)->make());

        $res = $this->actingAs($user)
            ->json('GET', route('userContext.publisher.books', [
                'publisher' => $p,
            ]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'books' => [
                        ['id','title','description'],
                    ],
                ],
            ])->json();

        $this->assertTrue(starts_with($res['data']['books'][0]['title'], 'en:'));
        $this->assertTrue(starts_with($res['data']['books'][0]['description'], 'en:'));
    }



    /** @test */
    public function show_should_404_when_publisher_doesnt_exist()
    {
        $this->json('GET', route('userContext.publisher.show', 10000000000000000))
            ->assertStatus(404);
    }


}
