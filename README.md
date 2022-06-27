# Weather App API

### For Weather API
```
    https://www.visualcrossing.com/
```

## Model
``App\Models\Weather``

## Actions

`` App\Actions\Weather\CreateWeatherFromApiResponse ``

`` App\Actions\Weather\GetWeatherByAddressDate ``


## Event and Listener

``App\Providers\EventServiceProvider::class ``
```php
CreateWeatherFromAPIEvent::class => [
    CreateWeatherFromAPIListener::class,
],
```

## Task Schedule
Job
``App\Jobs\CreateWeatherFromAPI::class ``

### ``App\Console\Kernel::class ``
```php
    $schedule->call(function () {
            FetchWeatherJob::dispatch();
        })->everySixHours();
```

### Main Logic
```php

class CreateWeatherFromApiResponse
{
    use AsAction;

    public function handle(Address $address, $date)
    {

        // if invalid date format
        Validator::make(['date' => $date], [
            'date' => 'date_format:Y-m-d',
        ])->validate();

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . env('API_KEY'),
        ])->get(config('api.api_host') . 'VisualCrossingWebServices/rest/services/timeline/' . $address->address . '/' . $date . '?unitGroup=metric&key=' . env('API_KEY') . '&contentType=json');

        if($response->status() != 200) {
            throw new \Exception('Error fetching weather data');
        }
        $result = $response->json();

        $weather = $address->weather()->updateOrCreate(
            [
                'date'=> $date,
            ],
            [
            'date'=>$result['days'][0]['datetime'],
            'temp_max'=>$result['days'][0]['tempmax'],
            'temp_min'=>$result['days'][0]['tempmin'],
            'temp'=>$result['days'][0]['temp'],
            'dew'=>$result['days'][0]['dew'],
            'humidity'=>$result['days'][0]['humidity'],
            'snow'=>$result['days'][0]['snow'],
            'sunrise'=>$result['days'][0]['sunrise'],
            'sunset'=>$result['days'][0]['sunset'],
            'conditions'=>$result['days'][0]['conditions'],
            'description'=>$result['days'][0]['description'],
        ]);
        return $weather;
    }
}

```


## Tests

``Tests\Feature\AddressApiTest``
``Tests\Feature\WeatherApiTest``









