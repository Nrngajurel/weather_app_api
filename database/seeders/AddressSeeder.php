<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
            'address' => 'New York',
            'latitude' => '40.730610',
            'longitude' => '-73.935242',
            'timezone' => 'America/New_York',
        ]);
        Address::create([
            'address' => 'London',
            'latitude' => '51.507351',
            'longitude' => '-0.127758',
            'timezone' => 'Europe/London',
        ]);
        Address::create([
            'address' => 'Paris',
            'latitude' => '48.856614',
            'longitude' => '2.352222',
            'timezone' => 'Europe/Paris',
        ]);
        Address::create([
            'address' => 'Berlin',
            'latitude' => '52.520007',
            'longitude' => '13.404954',
            'timezone' => 'Europe/Berlin',
        ]);
        Address::create([
            'address' => 'Tokyo',
            'latitude' => '35.689487',
            'longitude' => '139.691711',
            'timezone' => 'Asia/Tokyo',
        ]);

    }
}
