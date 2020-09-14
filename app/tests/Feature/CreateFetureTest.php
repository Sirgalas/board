<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateFetureTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFull()
    {
        $response = $this->post("/admin/users",['name'=>'name','email'=>'email@email.com']);
        $response->assertStatus(302);
    }

}
