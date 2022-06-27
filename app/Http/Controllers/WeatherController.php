<?php

namespace App\Http\Controllers;

use App\Actions\Weather\GetWeatherByAddressDate;
use App\Http\Requests\StoreWeatherRequest;
use App\Http\Requests\UpdateWeatherRequest;
use App\Models\Address;
use App\Models\Weather;

class WeatherController extends Controller
{



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWeatherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWeatherRequest $request)
    {
        $address = Address::find($request->address_id);
        try {
            $weather = $address->weather()->create($request->all());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function weatherByAddressDate(Address $address, $date)
    {
        $weather = GetWeatherByAddressDate::run($address, $date);

        return response()->json($weather);
    }

    public function weatherByAddress(Address $address)
    {

        return response($address->load('weather'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWeatherRequest  $request
     * @param  \App\Models\Weather  $weather
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWeatherRequest $request, Weather $weather)
    {
        try {
            $weather->update($request->all());
            return response()->json($weather, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weather  $weather
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weather $weather)
    {
        try {
            $weather->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
