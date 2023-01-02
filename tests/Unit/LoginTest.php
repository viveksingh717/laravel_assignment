<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_login()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_user_login_with_credential()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $log = $this->post('login', [
            'email'=>$user->email,
            'password'=>'password',
        ]);

        $this->assertAuthenticated();
    }
}
