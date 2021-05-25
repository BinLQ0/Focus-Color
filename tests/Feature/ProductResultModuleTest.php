<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ProductResultModuleTest extends TestCase
{
    /** @test */
    public function test_simple_api()
    {
        $response = $this->get('/api/result');
        $response->assertStatus(200);
    }

    /** @test */
    public function auth_user_visit_index_page()
    {
        $response = $this->actingAs($this->getUser('manufacture module'))
            ->get('/result');

        $response->assertStatus(200)
            ->assertSee('Product Result');
    }

    /** @test */
    public function auth_visit_create_page()
    {
        $response = $this->actingAs($this->getUser('result-create'))
            ->get('/result/create');

        $response->assertStatus(200)
            ->assertSee('Create Product Result');
    }

    /** @test */
    public function auth_visit_edit_page()
    {
        $response = $this->actingAs($this->getUser('result-update'))
            ->get('/result/206/edit');

        $response->assertStatus(200)
            ->assertSee('Edit Product Result');
    }

    /** @test */
    public function unauthorize_user_visit_index_page()
    {
        $response = $this->get('/result');
        $response->assertStatus(302);
    }

    /** @test */
    public function unauthorize_visit_create_page()
    {
        $response = $this->get('/result/create');
        $response->assertStatus(302);
    }

    /** @test */
    public function unauthorize_visit_edit_page()
    {
        $response = $this->get('/result/206/edit');
        $response->assertStatus(302);
    }

    /**
     * Get User
     * @return App\Models\User
     */
    private function getUser($permission): User
    {
        return User::permission($permission)->first();
    }
}
