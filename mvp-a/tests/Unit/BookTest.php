<?php

namespace Tests\Unit;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BookTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /** @test */
    public function should_be_instantiatable()
    {
        $book = new Book;

        $this->assertNotNull($book);
    }

    /** @test */
    public function should_have_publisher_relation()
    {
        $book = factory(Book::class)->create();

        $this->assertNotNull($book->publisher);
        $this->assertInstanceOf(BelongsTo::class, $book->publisher());
    }

    /** @test */
    public function should_have_categories_relation()
    {
        $book = factory(Book::class)->create();

        $this->assertNotNull($book->categories);
        $this->assertInstanceOf(BelongsToMany::class, $book->categories());
    }



}
