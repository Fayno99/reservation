<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Organization;
use App\Models\TemporaryOrder;

class APITest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    protected $organization;

    protected function setUp(): void
    {
        parent::setUp();

        $this->organization = Organization::create([
            'companyId' => '1',
            'token' => '12345',
        ]);

        $this->withSession(['session_id' => uniqid('session_', true)]);
    }

    protected function headers()
    {
        return [
            'X-Organization-Token' => $this->organization->token,
            'X-Session-ID' => 123456,
        ];
    }

    public function testSelectDataCompany()
    {
        $response = $this->postJson('/api/selectData', [
            'companies_id' => 1
        ], $this->headers());

        $response
            ->assertStatus(200)
            ->assertJson([
                'next_step' => 'select_master'
            ]);

        $this->assertDatabaseHas('temporary_orders', [
            'companies_id' => 1
        ]);
    }

    public function testSelectDataMaster()
    {
        $this->postJson('/api/selectData', [
            'companies_id' => 1
        ], $this->headers());

        $response = $this->postJson('/api/selectData', [
            'masters_id' => 1
        ], $this->headers());

        $response
            ->assertStatus(200)
            ->assertJson([
                'next_step' => 'select_service'
            ]);

        $this->assertDatabaseHas('temporary_orders', [
            'masters_id' => 1
        ]);
    }

    public function testSelectDataService()
    {
        $this->postJson('/api/selectData', [
            'companies_id' => 1
        ], $this->headers());

        $this->postJson('/api/selectData', [
            'masters_id' => 1
        ], $this->headers());

        $response = $this->postJson('/api/selectData', [
            'works_id' => 1
        ], $this->headers());

        $response
            ->assertStatus(200)
            ->assertJson([
                'next_step' => 'select_time_slot'
            ]);

        $this->assertDatabaseHas('temporary_orders', [
            'works_id' => 1
        ]);
    }

    public function testSelectDataTimeSlot()
    {
        $this->postJson('/api/selectData', [
            'companies_id' => 1
        ], $this->headers());

        $this->postJson('/api/selectData', [
            'masters_id' => 1
        ], $this->headers());

        $this->postJson('/api/selectData', [
            'works_id' => 1
        ], $this->headers());

        $response = $this->postJson('/api/selectData', [
            'time_slot' => '',
            'start_order' => '2023-01-01 12:00',
            'stop_order' => '2023-01-01 13:00'
        ], $this->headers());

        $response
            ->assertStatus(200)
            ->assertJson([
                'next_step' => 'enter_user_data'
            ]);

        $this->assertDatabaseHas('temporary_orders', [
            'start_order' => '2023-01-01 12:00',
            'stop_order' => '2023-01-01 13:00'
        ]);
    }

    public function testSelectUserData()
    {
        $this->postJson('/api/selectData', [
            'companies_id' => 1
        ], $this->headers());

        $this->postJson('/api/selectData', [
            'masters_id' => 1
        ], $this->headers());

        $this->postJson('/api/selectData', [
            'works_id' => 1
        ], $this->headers());

        $this->postJson('/api/selectData', [
            'time_slot' => '',
            'start_order' => '2023-01-01 12:00',
            'stop_order' => '2023-01-01 13:00'
        ], $this->headers());

        $response = $this->postJson('/api/selectData', [
            'motorcycles' => 'Yamaha',
            'users_id' => 1,
            'client' => '',
            'name' => 'John',
            'email' => 'john@test.com',
            'telephone' => '1234567890',

        ], $this->headers());

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'All data collected. Ready to submit order.'
            ]);

        $this->assertDatabaseHas('temporary_orders', [
            'motorcycles' => 'Yamaha',
            'users_id' => 1,
            'clients_id' => 1,
        ]);
    }
}
