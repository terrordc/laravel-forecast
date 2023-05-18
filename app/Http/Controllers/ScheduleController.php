<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forecast;
class ScheduleController extends Controller
{
   public function GetForecast(){

        $url = "https://api.open-meteo.com/v1/forecast?latitude=54.99&longitude=73.37&hourly=temperature_2m&current_weather=true";

            $forecast = Forecast::create($input = [
                'title' => 'Demo Title',
                'data' => file_get_contents($url),
            ]
        );
    }
}
