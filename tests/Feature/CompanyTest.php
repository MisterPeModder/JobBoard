<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Company;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A Testing users table
     *
     * @return void
     */
    public function test_that_companies_table_can_be_filled_with_fake_values()
    {
        $users = Company::factory(10)->make();
        echo $users . "\n";
    }

}
