<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forecast;
use DateTimeZone;
use DateTime;

class Day{
    public $dayofweek;
    public $temperature_max;
    public $temperature_min;
    public $weather_code_image;
}

class ForecastController extends Controller
{
    public function GetForecast(){
        $json = $this->GetJsonData();
        $nowDatetime = $this->GetDateTime($json);
        $temperature = $this->GetTemperature($json);
        $weather_code = $this->GetWeatherCode($json);
        $wind_speed = $this->GetWindSpeed($json);
        $humidity = $this->GetHumidity($json, $this->GetHourIndex($json));
        $precipitation_probability = $this->GetPrecipitationProbability($json, $this->GetHourIndex($json));
        $week = $this->GetWeekCardForecast($json);


        return view('welcome', ['temperature' => $temperature,
                                'nowDatetime'=> $nowDatetime,
                                'weather_code' =>$weather_code['description'],
                                'weather_code_image' =>$weather_code['image'],
                                'humidity' => $humidity,
                                'wind_speed' =>$wind_speed,
                                'precipitation_probability' => $precipitation_probability,
                                'week' => $week,     
                            ]);
    
    }

    public function GetJsonData(){
        $forecast = Forecast::latest()->first();
        return json_decode($forecast->data); #get json data from database
    }

    public function GetDateTime($json){
        $datetime = new DateTime("now", new DateTimeZone($json->timezone)); # datetime object with timezone from api url parameter
        return $datetime->format('l | H:i'); # format to day, hour and minutes
    }

    public function FormatTemperature($temperature, $hourly_unit){
        $temperature = round($temperature);
        if($temperature > 0){    # if temp is positive convert to string and
            $temperature = '+' . strval($temperature); #add plus sign
        }
        else{
            $temperature = strval($temperature); # do nothing
        }
        return $temperature . $hourly_unit; # add temperature unit from url (celsius or farengheith)
    }

    public function GetTemperature($json){
       return $this->FormatTemperature($json->current_weather->temperature, $json->hourly_units->temperature_2m);
      
    }

    public function GetCodeDescriptions(){
       return json_decode(file_get_contents(public_path('json\descriptions.json')));#get descripton for codes
    }

    public function GetWeatherCode($json){
        $weather_code = $json->current_weather->weathercode; #current weather code

        $descriptions = $this->GetCodeDescriptions();

            $is_day = $json->current_weather->is_day; # is now the day parameter
                if($is_day == 0){
                    $time_of_day = 'night';
                }
                else{
                    $time_of_day = 'day';
                }
        return ['description' => $descriptions->$weather_code->$time_of_day->description,
        'image' => $descriptions->$weather_code->$time_of_day->image]; #description for current weather code
    }

    public function GetWindSpeed($json){
        return $json->current_weather->windspeed . ' ' . $json->hourly_units->windspeed_10m;
    }   

    public function GetHourIndex($json){ #get current index for accessing hourly params
       $current_time = $json->current_weather->time;
      return array_search($current_time, $json->hourly->time);
    }

    public function GetHumidity($json, $hour_index){
        return $json->hourly->relativehumidity_2m[$hour_index] . $json->hourly_units->relativehumidity_2m;
     }

     public function GetPrecipitationProbability($json, $hour_index){
        return $json->hourly->precipitation_probability[$hour_index] . $json->hourly_units->precipitation_probability;
     }

     public function GetWeekCardForecast($json){
        
        $descriptions = $this->GetCodeDescriptions();
        $number_of_days = count($json->daily->time);
        $week = array();
            for($i = 0; $i <= $number_of_days-1; $i++){
                $day = new Day(); 
                $day->dayofweek = date('D', strtotime($json->daily->time[$i]));
                $weather_code = $json->daily->weathercode[$i];

                $day->temperature_max = $this->FormatTemperature($json->daily->temperature_2m_max[$i], $json->daily_units->temperature_2m_max);
                $day->temperature_min = $this->FormatTemperature($json->daily->temperature_2m_min[$i], $json->daily_units->temperature_2m_min);
                $day->weather_code_image = $descriptions->$weather_code->day->image;
                array_push($week, $day);
            }
        return $week;
     }



    public function GetGraphData(){
        $response = array();
        $json = $this->GetJsonData();
        $hourly_time = $json->hourly->time;
        $hourly_temp = $json->hourly->temperature_2m;
        array_push($response,  $this->GetSlicedData($hourly_time, $json)); 
        array_push($response,  $this->GetSlicedData($hourly_temp, $json));
        return $response;
        
    }

    public function GetSlicedData($hourly_n, $json){
        
        $hour_index = $this->GetHourIndex($json);
    $sliced = array_slice($hourly_n, $hour_index);
        $result = array();
        $source = array_values($sliced);
        $count = count($source);
            for($i = 0; $i < $count; $i += 3) {
                $result[] = $source[$i];
            }
       return $result;
    }
}
