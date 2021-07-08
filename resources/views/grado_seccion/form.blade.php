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
    <label for="grado_id">Grado</label>
    <select required name="grado_id" id="grado_id" class="custom-select" value="{{ old('grado_id') }}">
        <option value="{{ -1 }}">Seleccionar grado</option>
        @foreach($grados as $grado_item)
        <option value="{{ $grado_item->id }}" {{ isset($grado->grado_id) && $grado_item->id == $grado->grado_id ? 'selected' : '' }}>{{ $grado_item->descripcion }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="seccion_id">Sección</label>
    <select required name="seccion_id" id="seccion_id" class="custom-select" value="{{ old('seccion_id') }}">
        <option value="">Seleccionar sección</option>
        @foreach($secciones as $seccion_item)
        <option value="{{ $seccion_item->id }}" {{ isset($grado->seccion_id) && $seccion_item->id == $grado->seccion_id ? 'selected' : '' }}>{{ $seccion_item->descripcion }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="capacidad">Capacidad de alumnos</label>
    <input required class="form-control" type="text" name="capacidad" id="capacidad" value="{{isset($grado->capacidad) ? $grado->capacidad : old('capacidad')}}">
</div>

<div class="form-group">
    <input class="btn btn-success" type="submit" value="{{$modo}} datos">
    <a class="btn btn-primary" href="{{url('grado-seccion')}}">Regresar</a>
</div>

</div>