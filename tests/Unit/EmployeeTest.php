<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class EmployeeTest extends TestCase
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
        $response = $this->get('/home');

        $response->assertStatus(200);

    }

    public function test_post_create_new_employee()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $log = $this->post('login', [
            'email'=>$user->email,
            'password'=>'password',
        ]);

        $this->assertAuthenticated();

        $this->post('store', [
            'company_id'=> 2,
            'first_name'=> 'vviek',
            'last_name'=>'singh',
            'email'=>'vivek@yahoo.com',
            'phone'=>'9856231774',
        ]);

        $this->assertEquals(1, Employee::count());

        $response = Employee::first();

        $this->assertEquals($response->email, 'vivek@yahoo.com');

    }

    public function test_get_employee()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $log = $this->post('login', [
            'email'=>$user->email,
            'password'=>'password',
        ]);

        $this->assertAuthenticated();

        $this->post('store', [
            'company_id'=> 2,
            'first_name'=> 'vviek',
            'last_name'=>'singh',
            'email'=>'vivek@yahoo.com',
            'phone'=>'9856231774',
        ]);

        $this->assertEquals(1, Employee::count());
    }

    public function test_post_update_employee()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $log = $this->post('login', [
            'email'=>$user->email,
            'password'=>'password',
        ]);

        $this->assertAuthenticated();

        $this->post('store', [
            'company_id'=> 2,
            'first_name'=> 'vviek',
            'last_name'=>'singh',
            'email'=>'vivek@yahoo.com',
            'phone'=>'9856231774',
        ]);

        $emp = Employee::first();

        $response = $this->post('update/'.$emp->id, [
            'company_id'=> 5,
            'first_name'=> 'updated name',
            'last_name'=>'updated singh',
            'email'=>'updated@yahoo.com',
            'phone'=>'98562374',
        ]);

        $updated = Employee::first();

        $this->assertEquals('updated name', $updated->first_name);
        $this->assertEquals('updated singh', $updated->last_name);

    }

    public function test_post_delete_employee()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $log = $this->post('login', [
            'email'=>$user->email,
            'password'=>'password',
        ]);

        $this->assertAuthenticated();

        $this->post('store', [
            'company_id'=> 2,
            'first_name'=> 'vviek',
            'last_name'=>'singh',
            'email'=>'vivek@yahoo.com',
            'phone'=>'9856231774',
        ]);

        $emp = Employee::first();

        $response = $this->get('delete/'.$emp->id);

        $this->assertEquals(0, Employee::count());

    }
}
