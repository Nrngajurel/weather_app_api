<?php

namespace Tests\Feature;

use App\Jobs\FetchWeatherJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class WeatherApiTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_weather_api_get_weather_by_address_test()
    {
        parent::setUp();
        $this->artisan('db:seed');
        FetchWeatherJob::dispatch();
        $response = $this->get('/api/weather/London');
        $response->assertStatus(200);
        $response->assertJsonStructure([
                    'id',
                    'address',
                    'latitude',
                    'longitude',
                    'timezone',
                    'created_at',
                    'updated_at',
                    'weather' => [
                        '*' => [
                            'id',
                            'date',
                            'temp_max',
                            'temp_min',
                            'temp',
                            'dew',
                            'humidity',
                            'snow',
                            'sunrise',
                            'sunset',
                            'conditions',
                            'description',
                            'address_id',
                            'created_at',
                            'updated_at',
                        ]
                    ]
        ]);
    }

    public function test_get_weather_by_address_and_date_test()
    {
        parent::setUp();
        $this->artisan('db:seed');
        FetchWeatherJob::dispatch();
        $response = $this->get('/api/weather/London/2020-01-01');
        $response->assertStatus(200);
        $response->assertJsonStructure([
                    'id',
                    'address',
                    'latitude',
                    'longitude',
                    'timezone',
                    'created_at',
                    'updated_at',
                    'weather' => [
                        '*' => [
                            'id',
                            'date',
                            'temp_max',
                            'temp_min',
                            'temp',
                            'dew',
                            'humidity',
                            'snow',
                            'sunrise',
                            'sunset',
                            'conditions',
                            'description',
                            'address_id',
                            'created_at',
                            'updated_at',
                        ]
                    ]
        ]);
    }


    public function test_weather_store(){
        //         date
        // temp_max
        // temp_min
        // temp
        // dew
        // humidity
        // snow
        // sunrise
        // sunset
        // conditions
        // description
        // address_id

        parent::setUp();
        $this->artisan('db:seed');

        $response = $this->post('/api/weather', [
            'date' => '2020-01-01',
            'temp_max' => '37.7749295',
            'temp_min' => '-122.4194155',
            'temp' => 20,
            'dew' => 20,
            'humidity' => 75,
            'snow' => 0,
            'sunrise' => "05:26:56",
            'sunset' => "20:31:20",
            'conditions' => "Rain, Overcast",
            'description' => "Cloudy skies throughout the day with storms possible.",
            'address_id' => 1,
        ]);
        $response->assertCreated();

        $weather = \App\Models\Weather::first();
        $this->assertJson($response->getContent(), $weather->toJson());

    }

    public function test_weather_update(){
        parent::setUp();
        $this->artisan('db:seed');
        FetchWeatherJob::dispatch();
// create
        $response = $this->post('/api/weather', [
            'date' => '2020-01-01',
            'temp_max' => '37.7749295',
            'temp_min' => '-122.4194155',
            'temp' => 20,
            'dew' => 20,
            'humidity' => 75,
            'snow' => 0,
            'sunrise' => "05:26:56",
            'sunset' => "20:31:20",
            'conditions' => "Rain, Overcast",
            'description' => "Cloudy skies throughout the day with storms possible.",
            'address_id' => 1,
        ]);
        $response->assertCreated();


// update
        $response = $this->put('/api/weather/1', [
            'date' => '2020-01-01',
            'temp_max' => '37.7749295',
            'temp_min' => '-122.4194155',
            'temp' => 20,
            'dew' => 20,
            'humidity' => 75,
            'snow' => 0,
            'sunrise' => "05:26:56",
            'sunset' => "20:31:20",
            'conditions' => "Rain, Overcast",
            'description' => "Cloudy skies throughout the day with storms possible.",
            'address_id' => 1,
        ]);
        $response->assertOk();
    }

    public function test_weather_delete(){
        parent::setUp();
        $this->artisan('db:seed');
        FetchWeatherJob::dispatch();
        $response = $this->delete('/api/weather/1');
        $response->assertStatus(204);
    }


}
