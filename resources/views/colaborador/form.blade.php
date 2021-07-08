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
    <input required class="form-control" type="text" name="dni" id="dni" value="{{isset($colaborador->dni) ? $colaborador->dni : old('dni')}}">
</div>

<div class="form-group">
    <label for="dni">Nombres</label>
    <input required class="form-control" type="text" name="nombres" id="nombres" value="{{isset($colaborador->nombres) ? $colaborador->nombres : old('nombres')}}">
</div>

<div class="form-group">
    <label for="dni">Apellidos</label>
    <input required class="form-control" type="text" name="apellidos" id="apellidos" value="{{isset($colaborador->apellidos) ? $colaborador->apellidos : old('apellidos')}}">
</div>

<div class="form-group">
    <label for="cargo_id">Cargo</label>
    <select name="cargo_id" id="cargo_id" class="custom-select" value="{{ old('cargo_id') }}">
        <option required value="">Seleccionar cargo</option>
        @foreach($cargos as $cargo)
        <option value="{{ $cargo->id }}" {{ isset($colaborador->cargo_id) && $cargo->id == $colaborador->cargo_id ? 'selected' : '' }}>{{ $cargo->descripcion }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">

    @if(isset($colaborador->foto))
    <img class="img-thumbnail" width="50" height="50" src="{{ asset('storage').'/'.$colaborador->foto }}" alt="Foto colaborador">
    @endif
    <input class="form-control" type="file" name="foto" id="foto">
</div>

<div class="form-group">
    <input class="btn btn-success" type="submit" value="{{$modo}} datos">
    <a class="btn btn-primary" href="{{url('colaborador')}}">Regresar</a>
</div>

</div>