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
    <label for="descripcion">Grado</label>
    <input required class="form-control" type="text" name="descripcion" id="descripcion" value="{{isset($grado->descripcion) ? $grado->descripcion : old('descripcion')}}">
</div>

<div class="form-group">
    <input class="btn btn-success" type="submit" value="{{$modo}} datos">
    <a class="btn btn-primary" href="{{url('grado')}}">Regresar</a>
</div>

</div>