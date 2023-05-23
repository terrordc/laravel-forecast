<?php

namespace App\Console\Commands;
use App\Models\Forecast;
use Illuminate\Console\Command;

class GetForecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-forecast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = "https://api.open-meteo.com/v1/forecast?latitude=55.10&longitude=73.35&hourly=temperature_2m,relativehumidity_2m,precipitation_probability,windspeed_10m,precipitation,weathercode&daily=weathercode,temperature_2m_max,temperature_2m_min&current_weather=true&windspeed_unit=ms&timezone=Asia/Almaty";
            $forecast = Forecast::create($input = [
                'title' => 'Demo Title',
                'data' => file_get_contents($url),
            ]
        );
        return 0;
    }
}
