<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Master;
use App\Models\User;
use App\Models\Work;
use App\Models\Work_order;
use App\Services\TimeSlotsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TimeSlotCalculationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_add_company_to_table()
    {
        $this->assertTrue(Schema::hasTable('companies'));
        $companyData = [
            'name' => 'MOTO WORK',
            'address' => 'fury side',
            'description' => 'work for fun',
        ];

        Company::create($companyData);
        $this->assertDatabaseHas('companies', $companyData);
    }

    public function test_add_master_to_table()
    {
        $this->assertTrue(Schema::hasTable('masters'));
        $masterData = [
            'name' => 'John Doe',
            'companies_id' => 1,
            'image' => '1716815861.jpg',
        ];

        Master::create($masterData);
        $this->assertDatabaseHas('masters', $masterData);
    }

    public function test_add_user_to_table()
    {
        $this->assertTrue(Schema::hasTable('users'));
        $masterData = [
            'name' => 'userTester',
            'email' => 'tester@test.com',
            'password' => 'password',
            'telephone' => '0123456789',
            'isAdmin' => '1',
        ];

        User::create($masterData);
        $this->assertDatabaseHas('users', [
            'name' => 'userTester',
            'email' => 'tester@test.com',
            'telephone' => '0123456789',
            'isAdmin' => '1',
        ]);
    }

    public function testSelectionWorker()
    {
        $this->assertTrue(Schema::hasTable('masters'));

    }

    public function test_save_master_id_to_session()
    {
        $id = 1;

        $response = $this->call('GET', route('saveMasterId', [$id]));
        Session::put('master_id', $id);

        $this->assertEquals($id, Session::get('master_id'));
        $response->assertRedirect(route('services'));

    }

    public function test_add_services_to_table()
    {
        $this->assertTrue(Schema::hasTable('works'));
        $worksData = [
            'name_of_work' => 'paint to red',
            'description' => 'all motorcycles',
            'price' => 1500,
            'time_for_work' => 300,
        ];

        Work::create($worksData);
        $this->assertDatabaseHas('works', $worksData);

        $response = $this->get("services");
        $response->assertStatus(200);
    }

    public function test_save_work_id_to_session_and_redirect()
    {
        $interval = 300;
        $workId = 1;

        $response = $this->get(route('save-work-id', ['interval' => $interval, 'workId' => $workId]));
        Session::put('service_id', $workId);
        Session::put('service_time_for_work', $interval);

        $this->assertEquals($workId, Session::get('service_id'));
        $this->assertEquals($interval, Session::get('service_time_for_work'));
        $response->assertRedirect(route('timeSlot', [$interval, $workId]));
    }

    public function testTimeSlotCalculation()
    {
        $service = new TimeSlotsService();
        $interval = 300;
        $idMaster = 1;
        $response = $this->get("services/{$interval}/{$idMaster}");
        $response->assertStatus(200);

        $timeSlots = $service->timeSlot($interval, $idMaster);
        $this->assertNotEmpty($timeSlots);

        $keys = array_keys($timeSlots);
        $firstDate = reset($keys);
        $firstSlot = reset($timeSlots[$firstDate]);

        $startDateTime = str_replace(' ', ' ', $firstDate . ' ' . $firstSlot['start_time']);
        $endDateTime = str_replace(' ', ' ', $firstDate . ' ' . $firstSlot['end_time']);

        $response = $this->get("/order/{$startDateTime}/{$endDateTime}");
        $response->assertStatus(200);
    }

    public function test_save_start_and_end_time_to_session_and_redirect()
    {
        $start = '2024-05-27 13:10';
        $stop = '2024-05-27 18:10';

        $response = $this->get(route('order', ['startSlot' => $start, 'endSlot' => $stop]));


        $this->assertEquals($start, Session::get('start-time'));
        $this->assertEquals($stop, Session::get('end-time'));
        Session::put('start-time', $start);
        Session::put('end-time', $stop);

        $response->assertStatus(200);
    }

    public function testClientCreation()
    {
        $clientData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'telephone' => '123-456-7890',
        ];

        $this->post('/order/store', $clientData);
        $this->assertDatabaseHas('clients', $clientData);
    }

    public function testOrderCreation()
    {
        Session::put('id_client', 2);
        Session::put('start-time', '2024-05-27 13:10');
        Session::put('end-time', '2024-05-27 18:10');
        Session::put('master_id', 1);
        Session::put('service_id', 1);
        $orderData = [
            'companies_id' => 1,
            'masters_id' => session('master_id'),
            'clients_id' => session('id_client'),
            'users_id' => 1,
            'works_id' => session('service_id'),
            'motorcycles' => 'Honda',
            'start_order' => session('start-time'),
            'stop_order' => session('end-time'),
        ];
        Work_order::create($orderData);

        $this->assertDatabaseHas('work_orders', $orderData);
    }

}
