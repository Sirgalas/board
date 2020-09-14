<?php

namespace Tests\Feature;

use App\Entity\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * @test
     */
    public function form():void
    {
        $response = $this->get('/login');
        $response->assertStatus(200)->assertSee('Login');
    }

    /**
     * @test
     */
    public function error():void
    {
        $response=$this->post('/login',[
            'name' => '',
            'email' => '',
        ]);
        $response->assertStatus(302)
            ->assertSessionHasErrors(['email', 'password']);
    }

    /**
     * @test
     */
    public function wait():void
    {
        $user=factory(User::class)->create(['status'=>User::STATUS_WAIT,'role'=>User::ROLE_USER]);

        $response=$this->post('/login',[
            'email'=>$user->email,
            'password'=>'secret'
        ]);
        $response
            ->assertStatus(302)
            ->assertRedirect('/')
            ->assertSessionHas('error', 'You need to confirm your account. Please check your email.');
    }

    /**
     * @test
     */
    public function active():void
    {
        $user=factory(User::class)->create(['status'=>User::STATUS_ACTIVE]);
        $response=$this->post('/login',[
            'email'=>$user->email,
            'password'=>'secret'
        ]);
        $response
            ->assertStatus(302)
            ->assertRedirect('/cabinet');

        $this->assertAuthenticated();
    }
}
