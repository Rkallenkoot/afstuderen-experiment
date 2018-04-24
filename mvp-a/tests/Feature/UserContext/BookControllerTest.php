<?php

namespace Tests\Feature\UserContext;

use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function should_return_books()
    {
        factory(Book::class, 15)->create();

        $this->json('GET', route('userContext.book.index'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'title',
                        'description',
                        'isbn',
                        'eISBN',
                    ],
                ],
                'links' => [],
                'meta' => [],
            ]);
    }

    /** @test */
    public function should_show_book()
    {
        $b = factory(Book::class)->create();

        $res = $this->json('GET', route('userContext.book.show', $b->id))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                    'isbn',
                    'eISBN',
                ],
            ]);
    }

    /** @test */
    public function should_404_on_show_book()
    {
        $this->json('GET', route('userContext.book.show', -1))
            ->assertStatus(404);
    }



}
