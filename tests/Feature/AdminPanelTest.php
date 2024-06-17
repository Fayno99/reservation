<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testNoAccessToAdminPage()
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response = $this->get('/adminDashboard');
        $response->assertStatus(302);
        $response = $this->get('/adminListOfWork');
        $response->assertStatus(302);
        $response = $this->get('/adminWorker');
        $response->assertStatus(302);
    }
    public function testAdminAccessToAdminPage()
    {
        $adminUser = User::factory()->create(['isAdmin' => 3]);
        $this->actingAs($adminUser);
        $response = $this->get('/admin');
        $response->assertStatus(200);
        $response = $this->get('/adminDashboard');
        $response->assertStatus(200);
        $response = $this->get('/adminListOfWork');
        $response->assertStatus(200);
        $response = $this->get('/adminWorker');
        $response->assertStatus(200);
        $response = $this->get('/dayOff');
        $response->assertStatus(200);
        $response = $this->get('/schedules');
        $response->assertStatus(200);
    }
    public function testManagerAccessToAdminPage()
    {
        $adminUser = User::factory()->create(['isAdmin' => 4]);
        $this->actingAs($adminUser);
        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response = $this->get('/adminDashboard');
        $response->assertStatus(302);
        $response = $this->get('/adminListOfWork');
        $response->assertStatus(302);
        $response = $this->get('/adminWorker');
        $response->assertStatus(302);
        $response = $this->get('/dayOff');
        $response->assertStatus(200);
        $response = $this->get('/schedules');
        $response->assertStatus(200);

    }
    public function testAssistantAccessToAdminPage()
    {
        $adminUser = User::factory()->create(['isAdmin' => 2]);
        $this->actingAs($adminUser);
        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response = $this->get('/adminDashboard');
        $response->assertStatus(302);
        $response = $this->get('/adminListOfWork');
        $response->assertStatus(302);
        $response = $this->get('/adminWorker');
        $response->assertStatus(302);
        $response = $this->get('/dayOff');
        $response->assertStatus(302);
        $response = $this->get('/schedules');
        $response->assertStatus(200);
    }

}
