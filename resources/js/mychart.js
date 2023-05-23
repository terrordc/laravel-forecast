import {Chart }  from 'chart.js/auto';
import zoomPlugin from 'chartjs-plugin-zoom';


Chart.register(zoomPlugin);

var xlabels = [];
var ydata = [];

async function getData() {
  const baseurl = window.location.origin;
  const response = await fetch(baseurl + '/graph');
  const data = await response.json();
  // var result = [];
  // for(var i in data[0]){
  //   result.push(i);
  // };
 xlabels = data[0];
 ydata = data[1];
  
  // // var result = JSON.parse(data[0]);
  // ydata.push(result);
  // // xlabels.push(data[0]);
  // console.log(result);
  // // console.log(data[0]);
  // console.log(ydata);
  // // console.log(xlabels);

}


async function chartIt(){
 await getData();
const ctx = document.getElementById('chart');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: xlabels,
      datasets: [{
        label: 'Temperature',
        data: ydata ,
        borderWidth: 1,
        tension: 0.4,
        fill: true,

      }]
    },
    options: {
      plugins: {
        zoom: {
          zoom: {
          wheel: {
            enabled: false,
            mode: 'x',
          },
          drag: {
            enabled: false,
            mode: 'x',
          }
        }
        }
      },
      scales: {
        x: {
         
          min: xlabels[0],  // Set the minimum value of the x-axis to show only part of the dataset
          max: xlabels[7],  // Set the maximum value of the x-axis to show only part of the dataset
          ticks: {
            display: true  // Hide the x-axis labels to prevent overlap
          }
        }
      },
    }});
}

  document.addEventListener('DOMContentLoaded', function(){
    const myElement = document.getElementById("card-0");
    
    myElement.className += " active";
  });

  chartIt();