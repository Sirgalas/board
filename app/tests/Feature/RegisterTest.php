<?php

namespace Tests\Feature;

use App\Entity\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * @test
     */
    public function form():void
    {
        $response = $this->get('/register');
        $response->assertStatus(200)->assertSee('Register');
    }

    /**
     * @test
     */
    public function error():void
    {
        $response=$this->post('/register',[
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);
        $response->assertStatus(302)
            ->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /**
     * @test
     */
    public function success():void
    {
        $user=factory(User::class)->make();
        $response=$this->post('/register',[
            'name'=>$user->name,
            'email'=>$user->email,
            'password'=>'secret',
            'password_confirm'=>'secret'
        ]);
        $response
            ->assertStatus(302)
            ->assertRedirect('/login')
            ->assertSessionHas('success', 'Check your email and click on the link to verify.');
    }

    /**
     * @test
     */
    public function verifyIncorrect():void
    {
        $response=$this->get('/verify/'.Str::uuid());
        $response->assertStatus(302)
            ->assertRedirect('/login')
            ->assertSessionHas('error','Sorry your link cannot be identified.');
    }

    /**
     * @test
     */
    public function verify():void
    {
        $user=factory(User::class)->create([
            'status'=>User::STATUS_WAIT,
            'verify_token'=>Str::uuid()
        ]);

        $response=$this->get('/verify/'.$user->verify_token);

        $response->assertStatus(302)
            ->assertRedirect('/login')
            ->assertSessionHas('success','Your e-mail is verified. You can now login.');
    }
}
