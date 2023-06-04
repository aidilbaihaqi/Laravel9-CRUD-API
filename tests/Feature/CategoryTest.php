<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * User can see all category data
     */
    public function test_user_can_see_all_category_data(): void
    {
        $response = $this->get('/categories');
        $response->assetStatus(200);
    }

    /**
     * User can add data
     */
    // public function test_user_can_add_a_category(): void
    // {
    //     
        
    // }
}
