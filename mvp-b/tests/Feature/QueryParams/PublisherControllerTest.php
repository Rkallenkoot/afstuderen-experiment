<?php

namespace Tests\Feature\QueryParams;

use App\Book;
use App\Publisher;
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

        $this->json('GET', route('queryParams.publisher.index'))
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

        $this->json('GET', route('queryParams.publisher.show', $p))
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

        $this->json('GET', route('queryParams.publisher.books', $p))
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
    public function show_should_404_when_publisher_doesnt_exist()
    {
        $this->json('GET', route('queryParams.publisher.show', 10000000000000000))
            ->assertStatus(404);
    }

    /** @test */
    public function should_return_publisher_books_localized()
    {
        $p = factory(Publisher::class)->create();
        $p->books()->saveMany(factory(Book::class, 20)->make());

        $nlRes = $this->json('GET', route('queryParams.publisher.books', [
            'publisher' => $p,
            'locale' => 'nl',
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

        $enRes = $this->json('GET', route('queryParams.publisher.books', [
            'publisher' => $p,
            'locale' => 'en',
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

        $this->assertTrue(starts_with($enRes['data']['books'][0]['title'], 'en:'));
        $this->assertTrue(starts_with($enRes['data']['books'][0]['description'], 'en:'));

        $this->assertTrue(starts_with($nlRes['data']['books'][0]['title'], 'nl:'));
        $this->assertTrue(starts_with($nlRes['data']['books'][0]['description'], 'nl:'));
    }

}
