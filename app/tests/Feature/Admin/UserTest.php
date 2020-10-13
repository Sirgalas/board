<?php

namespace Tests\Feature\Admin;

use App\Entity\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    private $admin;
    public function setUp(): void
    {
        parent::setUp();
        $this->admin=factory(User::class)->create(['role' => User::ROLE_ADMIN]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/admin');

        $response->assertStatus(302)
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function notPermission()
    {
        $user = factory(User::class)->create(['permission' => User::ROLE_USER]);

        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function permission()
    {
        $response = $this->actingAs($this->admin)->get('/admin/users');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function create()
    {
        $response= $this->actingAs($this->admin)->post('/admin/users',[
            'name'=>'Test Name',
            'email'=>'test@email.com'
        ]);
        $user=User::where('email','test@email.com')->first();
        $response->assertStatus(302)
        ->assertRedirect('/admin/users/'.$user->id);
    }
}
