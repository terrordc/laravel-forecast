// webpack.mix.js

let mix = require('laravel-mix');



// mix.copy('node_modules/chart.js/dist/chart.js', 'public/js/chart.js');
mix.js('resources/js/mychart.js', 'public/js');
mix.sourceMaps()