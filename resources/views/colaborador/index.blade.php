@extends('layouts.app')

@section('content')
<div class="container">

    @if(Session::has("mensaje"))
    <div class="alert alert-success" role="alert">
        {{Session::get("mensaje")}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif


    <a class="btn btn-success mb-2" href="{{url('colaborador/create')}}">Registrar nuevo colaborador</a>

    <table class="table table-striped table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Foto</th>
                <th scope="col">DNI</th>
                <th scope="col">NOMBRES</th>
                <th scope="col">APELLIDOS</th>
                <th scope="col">CARGO</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $colaboradores as $colaborador )
            <tr>
                <td>{{ $colaborador->id }}</td>
                <td><img class="img-thumbnail" width="100" height="100" src="{{ isset($colaborador->foto) ? asset('storage').'/'.$colaborador->foto : '' }}" alt="Foto colaborador"></td>
                <td>{{ $colaborador->dni }}</td>
                <td>{{ $colaborador->nombres }}</td>
                <td>{{ $colaborador->apellidos }}</td>
                <td>{{ $colaborador->cargo->descripcion }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ url('/colaborador/'.$colaborador->id.'/edit') }}">Editar</a>
                    <!-- convierte la petición de post a delete -->
                    <form class="d-inline" action="{{ url('/colaborador/'.$colaborador->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro de eliminar al colaborador?');" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $colaboradores->links() !!}
    <div>
        @endsection('content')