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
    <label for="dni">DNI</label>
    <input required class="form-control" type="text" name="dni" id="dni" value="{{isset($estudiante->dni) ? $estudiante->dni : old('dni')}}">
</div>

<div class="form-group">
    <label for="nombres">Nombres</label>
    <input required class="form-control" type="text" name="nombres" id="nombres" value="{{isset($estudiante->nombres) ? $estudiante->nombres : old('nombres')}}">
</div>

<div class="form-group">
    <label for="apellidos">Apellidos</label>
    <input required class="form-control" type="text" name="apellidos" id="apellidos" value="{{isset($estudiante->apellidos) ? $estudiante->apellidos : old('apellidos')}}">
</div>

<div class="form-group">
    <label for="fecha_nacimiento">Fecha de nacimiento</label>
    <input required class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{isset($estudiante->fecha_nacimiento) ? $estudiante->fecha_nacimiento : old('fecha_nacimiento')}}">
</div>

<div class="form-group">
    <label for="grado_seccion_id">Grado</label>
    <select required name="grado_seccion_id" id="grado_seccion_id" class="custom-select" value="{{ old('grado_seccion_id') }}">
        <option value="">Seleccionar grado</option>
        @foreach($grados as $grado)
        <option value="{{ $grado->id }}" {{ isset($estudiante->grado_seccion_id) && $grado->id == $estudiante->grado_seccion_id ? 'selected' : '' }}>{{ $grado->grado_seccion }}</option>
        @endforeach
    </select>
</div>

<hr>
<h2>Datos del apoderado</h2>

<!-- <div class="form-group">
    <label for="apoderado">Apoderado</label>
    <input class="form-control" type="text" name="apoderado" id="apoderado" value="{{isset($estudiante->apoderado) ? $estudiante->apoderado : old('apoderado')}}">
</div> -->

<div class="form-row opcion">
    <div class="col-md-4 mb-3">
        <label for="nombres_apoderado">Nombres</label>
        <input name="nombres_apoderado" type="text" class="form-control" id="nombres_apoderado" placeholder=""  value="{{isset($estudiante->nombres_apoderado) ? $estudiante->nombres_apoderado : old('nombres_apoderado')}}" required>
    </div>
    <div class="col-md-4 mb-3">
        <label for="apellidos_apoderado">Apellidos</label>
        <input name="apellidos_apoderado" type="text" class="form-control" id="apellidos_apoderado" placeholder=""  value="{{isset($estudiante->apellidos_apoderado) ? $estudiante->apellidos_apoderado : old('apellidos_apoderado')}}" required>
    </div>
    <div class="col-md-4 mb-3">
        <label for="celular_apoderado">Celular</label>
        <input name="celular_apoderado" type="text" class="form-control" id="celular_apoderado" placeholder=""  value="{{isset($estudiante->celular_apoderado) ? $estudiante->celular_apoderado : old('celular_apoderado')}}" required>
    </div>
</div>

<div class="form-group">
    <input class="btn btn-success" type="submit" value="{{$modo}} datos">
    <a class="btn btn-primary" href="{{url('estudiante')}}">Regresar</a>
</div>

</div>