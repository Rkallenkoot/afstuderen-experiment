<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    /** @test */
    public function should_have_locale_property()
    {
        $user = factory(User::class)->create([
            'locale' => 'nl',
        ]);

        $this->assertEquals('nl', $user->locale);
    }

}
