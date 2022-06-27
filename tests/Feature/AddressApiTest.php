<?php

namespace Tests\Feature;

use App\Jobs\FetchWeatherJob;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressApiTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_adress_api_route_test()
    {

        parent::setUp();
        $this->artisan('db:seed');
        $response = $this->get('/api/address');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'address',
                    'latitude',
                    'longitude',
                    'timezone',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }

    public function test_address_create_api_route_test()
    {
        // address
        // latitude
        // longitude
        // timezone
        $this->withoutExceptionHandling();
        $response = $this->post('/api/address', [
            'address' => '123 Main St',
            'latitude' => '37.7749295',
            'longitude' => '-122.4194155',
            'timezone' => 'America/Los_Angeles',
        ]);
        $response->assertCreated();

        $address = \App\Models\Address::first();
        $this->assertJson($response->getContent());

    }
    public function test_address_update_api_route_test()
    {
        // address
        // latitude
        // longitude
        // timezone
        $this->withoutExceptionHandling();

        $response = $this->post('/api/address', [
            'address' => '123 Main St',
            'latitude' => '37.7749295',
            'longitude' => '-122.4194155',
            'timezone' => 'America/Los_Angeles',
        ]);
        $response->assertCreated();


        $response = $this->put('/api/address/1', [
            'address' => 'Other',
            'latitude' => '37.7749295',
            'longitude' => '-122.4194155',
            'timezone' => 'America/Los_Angeles',
        ]);
        $response->assertOk();

        $address = \App\Models\Address::first();
        $this->assertJson($response->getContent());

    }

    public function test_address_delete_api_route_test()
    {
        // address
        // latitude
        // longitude
        // timezone
        $this->withoutExceptionHandling();

        $response = $this->post('/api/address', [
            'address' => '123 Main St',
            'latitude' => '37.7749295',
            'longitude' => '-122.4194155',
            'timezone' => 'America/Los_Angeles',
        ]);
        $response->assertCreated();

        $response = $this->delete('/api/address/1');
        $response->assertStatus(204);

        $address = \App\Models\Address::first();
        $this->assertNull($address);
    }
}
