@extends('layouts.app')

@section('content')
<div class="container">
<h4 class="card-header">Casos altos de bullying por grado</h4>

<canvas id="myChart" width="400" height="180"></canvas>

<form id="form1" action="{{ url('/rpt-res-grado') }}" method="POST">
  @csrf
</form>
    
<div>
@endsection('content')

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>

<!-- chart -->
<script>
var valores=[0,0,0,0];
var niveles=["Irrelevante","Bajo","Medio","Alto"];
const resultados = {
    "SIN RIESGO DE BULLYING":  ()=>{valores[0]++},
    "POTENCIAL CASO DE SUFRIR BULLYING":  ()=>{valores[1]++},
    "SUFRE BULLYNG CONSTATEMENTE":  ()=>{valores[2]++},
    "TRATAMIENTO URGENTE!": ()=>{valores[3]++}
  }
$(document).ready(function(){
  //Petición de los datos para el reporte
  $.ajax({
    url:"{{ url('/rpt-res-nivel') }}",
    method:'POST',
    data:{
      id:1,
      _token: $('input[name="_token"]').val()
    }
  }).done(function(res){
    
    var arreglo = JSON.parse(res);
    // console.log(arreglo.diagnosticos);
    var datos = arreglo.diagnosticos
    console.log("Length", datos.length)
    for (let index = 0; index < datos.length; index++) {

      resultados[datos[index].resultado]();
      
    }
    for (let index = 0; index < valores.length; index++) {
      valores[index]= valores[index]/datos.length *100;
      
    }
    
    generarGrafica();

  });

  //Gráfica de barras
  function generarGrafica(){
    var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: niveles,
          datasets: [{
              label: '% de Casos',
              data:valores,
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