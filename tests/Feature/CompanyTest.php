<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A Testing users table
     *
     * @return void
     */
    public function test_that_companies_table_can_be_filled_with_fake_values()
    {
        $companies = Company::factory(10)->make();
        echo $companies."\n";
    }
}
