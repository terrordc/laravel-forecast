<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forecast;
class ScheduleController extends Controller
{
   public function GetForecast(){
        $url = "https://api.open-meteo.com/v1/forecast?latitude=55.10&longitude=73.35&hourly=temperature_2m,relativehumidity_2m,precipitation_probability,windspeed_10m,precipitation,weathercode&daily=weathercode,temperature_2m_max,temperature_2m_min&current_weather=true&windspeed_unit=ms&timezone=Asia/Almaty";

            $forecast = Forecast::create($input = [
                'title' => 'Demo Title',
                'data' => file_get_contents($url),
            ]
        );
    }
}
