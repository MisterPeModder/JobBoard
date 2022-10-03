<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A Testing users table
     *
     * @return void
     */
    public function test_that_users_table_can_be_filled_with_fake_values()
    {
        $users = User::factory(10)->make();
        echo $users."\n";
    }
}
