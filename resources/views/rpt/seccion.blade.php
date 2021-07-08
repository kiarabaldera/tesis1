@extends('layouts.app')

@section('content')
<div class="container">
<h4 class="card-header mb-3">Casos altos de bullying por sección</h4>

<h5 class="font-weight-bold m-3">Grado: 1ro</h5>
<canvas id="myChart1" width="600" height="180"></canvas>
<h5 class="font-weight-bold m-3">Grado: 2do</h5>
<canvas id="myChart2" width="600" height="180"></canvas>
<h5 class="font-weight-bold m-3">Grado: 3ro</h5>
<canvas id="myChart3" width="600" height="180"></canvas>
<h5 class="font-weight-bold m-3">Grado: 4to</h5>
<canvas id="myChart4" width="600" height="180"></canvas>
<h5 class="font-weight-bold m-3">Grado: 5to</h5>
<canvas id="myChart5" width="600" height="180"></canvas>

<form id="form1" action="{{ url('/rpt-res-grado') }}" method="POST">
  @csrf
</form>
<div>
@endsection('content')

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>

<!-- chart -->
<script>
var valores1=[0,0,0]
var valores2=[0,0,0]
var valores3=[0,0,0]
var valores4=[0,0,0]
var valores5=[0,0,0]
var casos={
    "1A":()=>{valores1[0]++},
    "1B":()=>{valores1[1]++},
    "1C":()=>{valores1[2]++},
    "2A":()=>{valores2[0]++},
    "2B":()=>{valores2[1]++},
    "2C":()=>{valores2[2]++},
    "3A":()=>{valores3[0]++},
    "3B":()=>{valores3[1]++},
    "3C":()=>{valores3[2]++},
    "4A":()=>{valores4[0]++},
    "4B":()=>{valores4[1]++},
    "4C":()=>{valores4[2]++},
    "5A":()=>{valores5[0]++},
    "5B":()=>{valores5[1]++},
    "5C":()=>{valores5[2]++},
}
$(document).ready(function(){

    //Petición de los datos para el reporte
    $.ajax({
        url:"{{ url('/rpt-res-seccion') }}",
        method:'POST',
        data:{
        id:1,
        _token: $('input[name="_token"]').val()
        }
    }).done(function(res){
        //console.log(res);
        var arreglo = JSON.parse(res);
        console.log(arreglo.diagnosticos);
        var datos = arreglo.diagnosticos
        
        for (let index = 0; index < datos.length; index++) {
            casos[datos[index].grado_seccion]();
        }
        // console.log("valores1:", valores1)
        // console.log("valores2:", valores2)
        // console.log("valores3:", valores3)
        // console.log("valores4:", valores4)
        // console.log("valores5:", valores5)
        generarGrafica();

    });
    function generarGrafica(){
        //1ro
        var ctx1 = document.getElementById('myChart1').getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['A', 'B', 'C'],
                datasets: [{
                    label: 'N° de Casos',
                    data: valores1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //2do
        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['A', 'B', 'C'],
                datasets: [{
                    label: 'N° de Casos',
                    data: valores2,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //3ro
        var ctx3 = document.getElementById('myChart3').getContext('2d');
        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['A', 'B', 'C'],
                datasets: [{
                    label: 'N° de Casos',
                    data: valores3,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //4to
        var ctx4 = document.getElementById('myChart4').getContext('2d');
        var myChart4 = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['A', 'B', 'C'],
                datasets: [{
                    label: 'N° de Casos',
                    data: valores4,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //5to
        var ctx5 = document.getElementById('myChart5').getContext('2d');
        var myChart5 = new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: ['A', 'B', 'C'],
                datasets: [{
                    label: 'N° de Casos',
                    data: valores5,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

})
</script>
@endsection('scripts')