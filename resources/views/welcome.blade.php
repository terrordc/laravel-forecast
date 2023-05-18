<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body class="antialiased">
        <div class="container m-auto">
            <div class="forecast bg-dark d-flex justify-space-between">
                <div>
                        <img src="img/sunny_s_cloudy.png" alt="" style="vertical-align: unset">
                    <div class="text-white d-inline-block">
                        <div>+15°C</div>
                        <div>Воскресенье | 15:42</div>
                        <div>Ясно, переменная облачность</div>
                    </div>
                </div>
                <div class="d-inline-block text-right text-white ms-auto" style="text-align:right">
                    <div class="text-right">Вероятность осадков: 0% </div>
                    <div class="text-right">Влажность: 42%</div>
                    <div class="text-right">Ветер: 2 м/с</div>
                </div>
            </div>
            <div class="cards " style="background-color: #a7a7a7">
                <div class="b-card">
                    <div class="d-inline-block text-center">Вс</div><br>
                    <img src="img/sunny_s_cloudy.png" alt=""> 
                    <div class="d-flex justify-space-between">
                        <div class="">+16°</div>
                        <div class="">+3°</div>
                    </div>
                </div>   
            </div>
        </div>
    </body>
</html>
