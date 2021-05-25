<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class MaterialReleaseModuleTest extends TestCase
{
    /** @test */
    public function test_simple_api()
    {
        $response = $this->get('/api/release');
        $response->assertStatus(200);
    }

    /** @test */
    public function auth_user_visit_index_page()
    {
        $response = $this->actingAs($this->getUser('manufacture module'))
            ->get('/release');

        $response->assertStatus(200)
            ->assertSee('Release Material');
    }

    /** @test */
    public function auth_visit_create_page()
    {
        $response = $this->actingAs($this->getUser('release-create'))
            ->get('/release/create');

        $response->assertStatus(200)
            ->assertSee('Create Release Material');
    }

    /** @test */
    public function auth_visit_edit_page()
    {
        $response = $this->actingAs($this->getUser('release-update'))
            ->get('/release/837/edit');

        $response->assertStatus(200)
            ->assertSee('Edit Release Material');
    }

    /** @test */
    public function unauthorize_user_visit_index_page()
    {
        $response = $this->get('/release');
        $response->assertStatus(302);
    }

    /** @test */
    public function unauthorize_visit_create_page()
    {
        $response = $this->get('/release/create');
        $response->assertStatus(302);
    }

    /** @test */
    public function unauthorize_visit_edit_page()
    {
        $response = $this->get('/release/837/edit');
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
