<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;500;700&display=swap');
        </style> 
        <!-- font-family: 'Roboto', sans-serif; -->
        <title>Laravel</title>
        
        <!-- <script  type="module" src="{{ asset('js/chart.js') }}"></script> -->
        <link rel="stylesheet" href="css/style.css">
       
        
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body class="bg-dark">
        <div class="container m-auto bg-dark">
            <div class="forecast bg-dark d-flex justify-space-between align-items-center p-2">
                <div>
                        <img class="va-unset" src="{{$weather_code_image}}" alt="" >
                    <div class="text-white d-inline-block">
                        <h1 class="bolder p-0 m-0">
                                    {{$temperature}}
                           
                    </h1>
                        <div class="low-t">{{$nowDatetime}}</div>
                        <div class="low-t">{{$weather_code}}</div>
                    </div>
                </div>
                
                <!-- <div>   <h1 class="text-white text-center m-auto"></h1></div> -->
                <div class="d-inline-block text-right text-white ms-auto" >
                    
                    <div class="text-right low-t">Вероятность осадков: {{$precipitation_probability}} </div>
                    <div class="text-right low-t">Влажность: {{$humidity}}</div>
                    <div class="text-right low-t">Ветер: {{$wind_speed}} </div>
                    
                </div>
               
            </div>
            
            <canvas id="chart" style="width:720px; height: 150px" class="my-2"></canvas>
            
            <div class="cards bg-dark d-flex justify-content-between p-2" >
            @foreach ($week as $key=>$day)
                <div class="b-card rounded p-2 opaque-bg text-white" id="card-{{$key}}">
                    <div class="text-center bolder">{{$day->dayofweek}}</div>
                    <img class="m-auto d-block" src="{{$day->weather_code_image}}" alt=""> 
                    <div class="text-center" style="width: max-content">
                        <div class="d-inline-block">{{$day->temperature_max}}</div>
                        <div class="d-inline-block low-t">{{$day->temperature_min}}</div>
                    </div>
                </div> 
                @endforeach
                
            </div>
        </div>
        <script  src="js/mychart.js"></script>
    </body>
</html>
