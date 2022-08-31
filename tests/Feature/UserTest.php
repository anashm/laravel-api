<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_register(){
        $user = $this->createUser();
       
        $this->assertDatabaseHas('users',  $user->toArray());

       
    }

    public function test_login(){
        $response = $this->postJson('api/users/login',[
            'email' => 'email@gmail.com',
            'password' => 'password'
        ])->assertStatus(self::HTTP_CREATED)
            ->assertSuccessful();

        $this->assertArrayHasKey('userID',$response->json());
    }

  

}
