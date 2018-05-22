<?php

namespace Tests\Feature\UserContext;

use App\Book;
use App\User;
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

    /** @test */
    public function should_return_books_in_user_locale()
    {
        $user = factory(User::class)->create([
            'locale' => 'en',
        ]);

        $book = factory(Book::class)->create([
            'title' => 'Nice Book',
            'description' => 'Very nice book',
        ]);
        app()->setLocale('nl');
        $book->update([
            'title' => 'Mooi boek',
            'description' => 'Heel mooi boek',
        ]);

        $res = $this->actingAs($user)
            ->json('GET', route('userContext.book.show', $book->id))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                    'isbn',
                    'eISBN',
                ],
            ])->json();
        $this->assertEquals('Nice Book', $res['data']['title']);
        $this->assertEquals('Very nice book', $res['data']['description']);
    }

    /** @test */
    public function should_fallback_to_english_when_locale_not_available()
    {
        $user = factory(User::class)->create([
            'locale' => 'nl',
        ]);

        $book = factory(Book::class)->create([
            'title' => 'Nice Book',
            'description' => 'Very nice book',
        ]);
        $book->forgetTranslation('title', 'nl');
        $book->forgetTranslation('description', 'nl');

        $res = $this->actingAs($user)
            ->json('GET', route('userContext.book.show', $book->id))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                    'isbn',
                    'eISBN',
                ],
            ])->json();
        $this->assertEquals('Nice Book', $res['data']['title']);
        $this->assertEquals('Very nice book', $res['data']['description']);
    }


}
