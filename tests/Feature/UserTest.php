<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

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
        echo $users . "\n";
        // display some values
        /*
        foreach($users as $user) {
        echo "id : ". $user->id . " ,Created : " . $user->created_at . " , Updated : " . $user->updated_at .
            ", Mail : " . $user->email . ", Name : " . $user->name;
        echo "\n";
        }
        */
    }
}
