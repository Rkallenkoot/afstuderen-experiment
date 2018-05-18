<?php

namespace Tests\Unit;

use App\Publisher;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PublisherTest extends TestCase
{

    /** @test */
    public function should_be_instantiable()
    {
        $publisher = new Publisher;

        $this->assertNotNull($publisher);
        $this->assertInstanceOf(Publisher::class, $publisher);
    }

    /** @test */
    public function should_have_books_relation()
    {
        $publisher = new Publisher;

        $this->assertInstanceOf(HasMany::class, $publisher->books());
    }
}
