<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('weather', function (Blueprint $table) {

//    "datetime": "2022-06-26",
//    "datetimeEpoch": 1656169200,
//    "tempmax": 34,
//    "tempmin": 25.1,
//    "temp": 28.8,
//    "feelslikemax": 37.1,
//    "feelslikemin": 25.1,
//    "feelslike": 30.7,
//    "dew": 21.1,
//    "humidity": 64.3,
//    "precip": 0,
//    "precipprob": 0,
//    "precipcover": 0,
//    "preciptype": null,
//    "snow": 0,
//    "snowdepth": 0,
//    "windgust": 48.2,
//    "windspeed": 28.6,
//    "winddir": 192.4,
//    "pressure": 1011.4,
//    "cloudcover": 38.1,
//    "visibility": 13.8,
//    "solarradiation": 293.8,
//    "solarenergy": 25.3,
//    "uvindex": 10,
//    "severerisk": 10,
//    "sunrise": "04:26:33",
//    "sunriseEpoch": 1656185193,
//    "sunset": "19:00:33",
//    "sunsetEpoch": 1656237633,
//    "moonphase": 0.97,
//    "conditions": "Partially cloudy",
//    "description": "Partly cloudy throughout the day.",
            $table->id();
            $table->date('date');
            $table->integer('temp_max');
            $table->integer('temp_min');
            $table->integer('temp');
            $table->integer('dew');
            $table->integer('humidity');
            $table->integer('snow')->nullable();
            $table->string('sunrise');
            $table->string('sunset');
            $table->string('conditions');
            $table->string('description');
            $table->foreignId('address_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather');
    }
};
