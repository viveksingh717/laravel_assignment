<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CompanyTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_get_method()
    {
        $response = $this->get('/company');

        $response->assertStatus(200);

    }

    public function test_create_new_company()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $log = $this->post('login', [
            'email'=>$user->email,
            'password'=>'password',
        ]);

        $this->assertAuthenticated();

        $this->post('company_store', [
            'name' => 'Google',
            'email' =>'google@gmail.com',
            'logo' =>'9856231774.png',
        ]);

        $this->assertEquals(1, Company::count());

        $com = Company::first();

        $this->assertEquals($response->email, 'google@gmail.com');

    }

    public function test_get_company()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $log = $this->post('login', [
            'email'=>$user->email,
            'password'=>'password',
        ]);

        $this->assertAuthenticated();

        $this->post('company_store', [
            'name' => 'Amazon',
            'email' =>'amz@amz.com',
            'logo' =>'amz445.png',
        ]);

        $this->assertEquals(1, Company::count());
    }

    public function test_update_company()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $log = $this->post('login', [
            'email'=>$user->email,
            'password'=>'password',
        ]);

        $this->assertAuthenticated();

        $this->post('company_store', [
            'name' => 'Amazon',
            'email' =>'amz@amz.com',
            'logo' =>'amz445.png',
        ]);

        $cmp = Company::first();

        $response = $this->post('company_update/'.$cmp->id, [
            'name' => 'Microsoft',
            'email' =>'microsoft@outlook.com',
            'logo' =>'vgy67.png',
        ]);

        $updated = Company::first();

        $this->assertEquals('updated name', $updated->first_name);
        $this->assertEquals('updated singh', $updated->last_name);

    }

    public function test_delete_company()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $log = $this->post('login', [
            'email'=>$user->email,
            'password'=>'password',
        ]);

        $this->assertAuthenticated();

        $this->post('company_store', [
            'name' => 'Amazon',
            'email' =>'amz@amz.com',
            'logo' =>'amz445.png',
        ]);

        $cmp = Company::first();

        $response = $this->get('company_delete/'.$cmp->id);

        $this->assertEquals(0, Company::count());

    }
}
