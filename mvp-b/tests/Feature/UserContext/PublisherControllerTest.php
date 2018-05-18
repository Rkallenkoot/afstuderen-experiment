<?php

namespace Tests\Feature\UserContext;

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
    public function show_should_404_when_publisher_doesnt_exist()
    {
        $this->json('GET', route('userContext.publisher.show', 10000000000000000))
            ->assertStatus(404);
    }


}
