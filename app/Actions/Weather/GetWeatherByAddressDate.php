<?php

namespace App\Actions\Weather;

use App\Events\CreateWeatherFromAPIEvent;
use App\Models\Address;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class GetWeatherByAddressDate
{
    use AsAction;

    public function handle(Address $address, $date)
    {
        // https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/Tokyo/2022-06-26?unitGroup=metric&key=CRL44CV46TCAR24A6FE3HCNCH&contentType=json
        $weather = $address->weather()->where('date', $date)->first();
        if(!$weather) {
            // fetch weather from api
            // save weather to db
            $weather = CreateWeatherFromApiResponse::run($address, $date);
            event(new CreateWeatherFromAPIEvent($weather));


        }
        return $address->load(['weather' => function($query) use ($date) {
            $query->where('date', $date);
        }]);
    }
}
