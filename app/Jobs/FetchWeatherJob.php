<?php

namespace App\Jobs;

use App\Actions\Weather\CreateWeatherFromApiResponse;
use App\Actions\Weather\GetWeatherByAddressDate;
use App\Models\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchWeatherJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $addresses = Address::all();
        foreach($addresses as $address) {
            $date = date('Y-m-d');
            CreateWeatherFromApiResponse::run($address, $date);
        }
    }
}
