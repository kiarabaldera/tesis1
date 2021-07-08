<h1>{{$modo}} datos</h1>

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

<div class="form-group">
    <label for="descripcion">Pregunta</label>
    <input required class="form-control" type="text" name="descripcion" id="descripcion" value="{{isset($pregunta->descripcion) ? $pregunta->descripcion : old('descripcion')}}">
</div>

<div class="form-group">
    <label for="categoria_id">Categoría de pregunta</label>
    <select required name="categoria_id" id="categoria_id" class="custom-select" value="{{ old('categoria_id') }}">
        <option value="">Seleccionar categoria</option>
        @foreach($categoriasPreguntas as $categoria)
        <option value="{{ $categoria->id }}" {{ isset($pregunta->categoria_id) && $categoria->id == $pregunta->categoria_id ? 'selected' : '' }}>{{ $categoria->descripcion }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <div class="d-flex justify-content-between align-items-center">
        <label for="categoria_id">Opciones</label>
        <input type="button" class="btn btn-primary" id="agregarOpcion" value="Agregar">
    </div>
    <div class="form-row">
        <div class="col-md-5">
            <label for="validationDefault01">Descripcion</label>
        </div>
        <div class="col-md-5">
            <label for="validationDefault02">Puntaje</label>
        </div>
    </div>
    <div class="opciones">
        @if (isset($pregunta->descripciones))
        @for ($i = 0; $i < count($pregunta->descripciones); $i++)
            <div class="form-row opcion">
                <div class="col-md-5 mb-3">
                    <input name="descripciones[{{ $i }}]" type="text" class="opcion-descripcion form-control" id="validationDefault01" placeholder="Descripcion" value="{{ $pregunta->descripciones[$i] }}" required>
                </div>
                <div class="col-md-5 mb-3">
                    <input name="puntajes[{{ $i }}]" type="text" class="opcion-puntaje form-control" id="validationDefault02" placeholder="Puntaje" value="{{ $pregunta->puntajes[$i] }}" required>
                </div>
                <div class="col-md-2 mb-3">
                    <input type="button" class="btn btn-danger btn-block eliminar" value="Eliminar">
                </div>
            </div>
        @endfor
        @endif
    </div>
</div>

<div class="form-group">
    <input class="btn btn-success" type="submit" value="{{$modo}} datos">
    <a class="btn btn-primary" href="{{url('pregunta')}}">Regresar</a>
</div>

</div>


@section('scripts')

<script>
    const agregarEventoEliminar = () => {
        const btnsEliminar = document.getElementsByClassName("eliminar");
        for (const btn of btnsEliminar) {
            btn.addEventListener("click", (e) => {
                e.preventDefault();
                btn.closest(".form-row.opcion").remove();
            });
        }
    }

    const createTemplate = (descripcion = "", puntaje = 0) => {
        const container = document.createElement("div");
        const index = document.getElementsByClassName("form-row opcion").length;
        container.className = "form-row opcion";
        const opcion = `
            <div class="col-md-5 mb-3">
                <input required name="descripciones[${index}]" type="text" class="opcion-descripcion form-control" id="validationDefault01" placeholder="Descripcion" value="${descripcion}">
            </div>
            <div class="col-md-5 mb-3">
                <input required name="puntajes[${index}]" type="text" class="opcion-puntaje form-control" id="validationDefault02" placeholder="Puntaje"  value="${puntaje}">
            </div>
            <div class="col-md-2 mb-3">
                <input type="button" class="btn btn-danger btn-block eliminar" value="Eliminar">
            </div>
        `
        container.innerHTML = opcion;
        return container;
    }

    const btnAgregar = document.getElementById("agregarOpcion");
    agregarEventoEliminar();
    btnAgregar.addEventListener("click", (e) => {
        e.preventDefault();
        const opciones = document.getElementsByClassName("opciones")[0];
        opciones.appendChild(createTemplate());
        agregarEventoEliminar();
    })
</script>


@endsection('scripts')