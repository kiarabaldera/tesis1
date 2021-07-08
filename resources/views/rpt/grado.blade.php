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
var valores=[0,0,0,0,0];
var grados=["1ro","2do","3ro","4to","5to"];
$(document).ready(function(){
  //Petición de los datos para el reporte
  $.ajax({
    url:"{{ url('/rpt-res-grado') }}",
    method:'POST',
    data:{
      id:1,
      _token: $('input[name="_token"]').val()
    }
  }).done(function(res){
    // console.log(res);
    var arreglo = JSON.parse(res);
    // console.log(arreglo.diagnosticos);
    var datos = arreglo.diagnosticos
    
    for (let index = 0; index < datos.length; index++) {
      // if (grados.indexOf(datos[index].grado) === -1) {
      //   //colDatos.push(key);
      //   grados.push(datos[index].grado);
        
      //   //console.log(typeof(parseInt(datos[index].grado,10)));
      // }
      switch (datos[index].grado) {
        case "1":
          valores[parseInt(datos[index].grado,10)-1]++
          break;
        case "2":
          valores[parseInt(datos[index].grado,10)-1]++
          break;
      
        case "3":
          valores[parseInt(datos[index].grado,10)-1]++
          break;
      
        case "4":
          valores[parseInt(datos[index].grado,10)-1]++
          break;

        case "5":
          valores[parseInt(datos[index].grado,10)-1]++
          break;
      
        
        
      
        default:
          break;
      }
      
      
    }
    generarGrafica();

  });

  //Gráfica de barras
  function generarGrafica(){
    var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: grados,
          datasets: [{
              label: 'N° de Casos',
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