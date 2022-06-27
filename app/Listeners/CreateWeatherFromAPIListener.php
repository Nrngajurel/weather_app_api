<?php

namespace App\Listeners;

use App\Events\CreateWeatherFromAPIEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CreateWeatherFromAPIListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CreateWeatherFromAPIEvent  $event
     * @return void
     */
    public function handle(CreateWeatherFromAPIEvent $event)
    {
        $message = 'New weather created: ' . $event->weather->address . ' ' . $event->weather->date;
        Log::info($message);
    }
}
