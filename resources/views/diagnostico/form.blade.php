<h3>TEST DE ALUMNO</h3>

@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
  <ul>
    @foreach ($errors->all() as $error )
    <li>
      {{$error}}
    </li>
    @endforeach
  </ul>
</div>

@endif
<!-- inputs escondidos que contienen data -->
<input type="hidden" type="text" id="estudiante_id" name="estudiante_id" value="{{$estudiante->id}}">
<input type="hidden" value="{{url('/')}}" id="url">
<input type="hidden" value="{{$modo}}" id="modo">
<input type="hidden" value="{{$modo=='Editar' ? $diagnostico->id : '-1'}}" id="id-diagnostico">
<!-- inputs escondidos que contienen data -->
<div class="data-alumno border rounded-lg pt-4 pr-4 pl-4">
  <div class="form-row">
    <div class="form-group col-sm-12 col-md-4">
      <label for="dni">DNI</label>
      <input disabled class="form-control" type="text" name="dni" id="dni" value="{{isset($estudiante->dni) ? $estudiante->dni : old('dni')}}">
    </div>
    <div class="form-group col-sm-12 col-md-4">
      <label for="dni">Nombres</label>
      <input disabled class="form-control" type="text" name="nombres" id="nombres" value="{{isset($estudiante->nombres) ? $estudiante->nombres : old('nombres')}}">
    </div>
    <div class="form-group col-sm-12 col-md-4">
      <label for="dni">Apellidos</label>
      <input disabled class="form-control" type="text" name="apellidos" id="apellidos" value="{{isset($estudiante->apellidos) ? $estudiante->apellidos : old('apellidos')}}">
    </div>
  </div>
</div>
<hr>
<div class="preguntas-alumnos border rounded-lg pt-4 pr-4 pl-4">
  <h3> <span class="badge badge-primary">Preguntas de alumnos</span></h3>
  @foreach ($preguntas as $key=>$pregunta )
  <div class="form-group">
    <label class="font-weight-bold" for="customRadio">{{$key + 1}}.) {{$pregunta->descripcion}}</label>
    <input class="pregunta" type="hidden" name="preguntas_id[{{ $key }}]" value="{{ $pregunta->id }}">
    <input class="categoria" type="hidden" name="categoria_pregunta[{{ $key }}]" value="{{ isset($pregunta->categoria->descripcion) ? $pregunta->categoria->descripcion : $pregunta->categoria }}">
    @foreach ($pregunta->opciones as $opcion )
    <div class="custom-control custom-radio">
      <input {{ isset($pregunta->opcion_seleccionada) && $pregunta->opcion_seleccionada == json_encode($opcion) ? 'checked' : '' }} required value="{{ json_encode($opcion) }}" type="radio" id="{{ $opcion->descripcion.$pregunta->id }}" name="respuesta[{{ $key }}]" class="custom-control-input respuesta">
      <label class="custom-control-label" for="{{ $opcion->descripcion.$pregunta->id }}"> {{ $opcion->descripcion}} </label>
    </div>
    @endforeach
  </div>
  @endforeach
</div>
<div class="form-group mt-2">
  <input id="submit-button" class="btn btn-success" type="button" value="Guardar datos">
  <a class="btn btn-primary" href="{{url('diagnostico')}}">Regresar</a>
</div>
</div>


@section('scripts')
<script src="{{ asset('js/tauprolog.js')}}"></script>
<script>
  const BASE_PATH = document.getElementById("url").value;
  const MODO = document.getElementById("modo").value;
  const ID_DIAGNOSTICO = document.getElementById("id-diagnostico").value;
  const submitButton = document.getElementById("submit-button");

  submitButton.addEventListener("click", async (e) => {
    e.preventDefault();
    var valid = true;
    // tiene el token csrf
    var formData = new FormData(document.querySelector('form'));
    // leer nodos de preguntas y respuestas
    const $preguntas = document.getElementsByClassName("pregunta");
    const $categoriaPreguntas = document.getElementsByClassName("categoria");
    const $respuestas = document.getElementsByClassName("respuesta");
    const estudianteId = document.getElementById("estudiante_id").value;
    const respuestas = [];
    const preguntas = [];
    const categoriaPreguntas = [];
    // llenar arreglos de respuestas y preguntas. El tamaño va a ser siempre el mismo, por eso se puede usar la misma iteracion.
    for (let i = 0; i < $preguntas.length; i++) {
      const $respuestaSeleccionada = document.querySelector(`input[name="respuesta[${i}]"]:checked`) || null;
      if (!$respuestaSeleccionada) {
        document.querySelector(`input[name="respuesta[${i}]"]`).focus();
        return;
      }
      const respuestaSeleccionada = $respuestaSeleccionada.value;
      respuestas.push(respuestaSeleccionada);
      preguntas.push($preguntas[i].value);
      categoriaPreguntas.push($categoriaPreguntas[i].value);
      // aprovechar la iteracion para ir agregando los datos al form data.
      formData.append("respuesta[]", respuestaSeleccionada);
      formData.append("preguntas_id[]", $preguntas[i].value);
    }
    //sacar las categorias.
    const categoriasUnicas = [...new Set(categoriaPreguntas)];
    const puntajesCategorias = {};
    //inicializar los contadores en 0 por cada categoria
    for (const categoria of categoriasUnicas) puntajesCategorias[categoria] = 0;
    // hacer los calculos de puntaje de las categorias
    for (let i = 0; i < respuestas.length; i++) {
      const categoria = categoriaPreguntas[i];
      const respuesta = JSON.parse(respuestas[i]);
      const puntajeActual = puntajesCategorias[categoria];
      puntajesCategorias[categoria] = puntajeActual + Number(respuesta.puntaje);
    }
    //hacemos esto porque ya se sabe que solo son categorias
    const puntajeCat1 = puntajesCategorias[categoriasUnicas[0]];
    const puntajeCat2 = puntajesCategorias[categoriasUnicas[1]];
    //obtener resultado del prolog en base al puntaje obtenido
    const diagnostico = await obtenerResultadoProlog(puntajeCat1,puntajeCat2);
    // llenar el form data que queda
    formData.append("estudiante_id", estudianteId);
    formData.append("resultado", diagnostico);
    try {
      let url = `${BASE_PATH}/diagnostico`;
      if (MODO === "Editar") {
        url = `${BASE_PATH}/diagnostico/${ID_DIAGNOSTICO}`;
        formData.append("_method", "PATCH")
      }
      const response = await fetch(url, {
        method: "POST",
        body: formData
      })
      window.location.href = `${BASE_PATH}/diagnostico`;
    } catch (error) {
      console.error(error);
    }
  })
  var session = pl.create();
  //VARIABLES
  //var nivel = -1;
  const reglas = `
    %Hechos
    %calcular_nivel
    calcular_nivel(nada,nada,0).
    calcular_nivel(nada,bajo,1).
    calcular_nivel(nada,medio,1).
    calcular_nivel(bajo,nada,1).
    calcular_nivel(bajo,bajo,1).
    calcular_nivel(medio,nada,1).
    calcular_nivel(nada,alto,2).
    calcular_nivel(bajo,medio,2).
    calcular_nivel(bajo,alto,2).
    calcular_nivel(medio,bajo,2).
    calcular_nivel(medio,medio,2).
    calcular_nivel(alto,nada,2).
    calcular_nivel(alto,bajo,2).
    calcular_nivel(medio,alto,3).
    calcular_nivel(alto,medio,3).
    calcular_nivel(alto,alto,3).

    %Reglas
    calcular_nivel_final(A,B,X):- calcular_nivel(A,B,X).

`;
  const calcular_nivel = (parCat1, parCat2) => {
    return new Promise((resolve, reject) => {
      session.consult(reglas, {
        success: function() {
          /* Program loaded correctly */
          //console.log("PL Succes!!");
          session.query(
            "calcular_nivel_final(" + parCat1 + "," + parCat2 + ", X ).", {
              success: function(goal) {
                /* Goal loaded correctly */
                // Answers
                session.answer({
                  success: function(answer) {
                    /* Answer */
                    // console.log("Rtp: ", session.format_answer(answer));
                    resolve(session.format_answer(answer))
                  },
                  error: function(err) {
                    /* Uncaught error */
                    console.log("Error:", err);
                  },
                  fail: function() {
                    /* Fail */
                    console.log("Fail");
                  },
                  limit: function() {
                    /* Limit exceeded */
                    console.log("Exceded");
                  },
                });
              },
              error: function(err) {
                /* Error parsing goal */
                console.log("Error query", err);
                console.log("Error query");
                reject(err);
              },
            }
          );
        },
        error: function(err) {
          console.log(err);
          console.log("Error!");
        },
      });
    })
  };

  //Nivel de categorías
  function nivel_categoria(numCat1, numCat2) {
    var nivel = {};
    //rangos cat 1
    nivel.cat1 = nivel_categoria1(numCat1);
    nivel.cat2 = nivel_categoria2(numCat2);

    return nivel;
  }
  //rangos cat 1
  function nivel_categoria1(numcat1) {
    if (numcat1 == 0) return "nada";
    if (numcat1 <= 9) return "bajo";
    if (numcat1 <= 18) return "medio";
    if (numcat1 > 18) return "alto";
  }
  //rangos cat 2
  function nivel_categoria2(numcat2) {
    if (numcat2 == 12) return "nada";
    if (numcat2 <= 16) return "bajo";
    if (numcat2 <= 20) return "medio";
    if (numcat2 > 20) return "alto";
  }

  const interpretaciones = {
    "X = 0.": "SIN RIESGO DE BULLYING",
    "X = 1.": "POTENCIAL CASO DE SUFRIR BULLYING",
    "X = 2.": "SUFRE BULLYNG CONSTATEMENTE",
    "X = 3.": "TRATAMIENTO URGENTE!"
  }
  //nivel prolog
  const obtenerResultadoProlog = async (numCat1, numCat2) => {
    nivel = nivel_categoria(numCat1, numCat2);
    const resultado = await calcular_nivel(nivel.cat1, nivel.cat2);
    const interpretacionFinal = interpretaciones[resultado];
    return interpretacionFinal;
  };
</script>
@endsection('scripts')