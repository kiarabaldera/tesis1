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

    <a class="btn btn-success mb-2" href="{{url('estudiante/create')}}">Registrar nuevo estudiante</a>

    <table class="table table-striped table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">DNI</th>
                <th scope="col">NOMBRES</th>
                <th scope="col">APELLIDOS</th>
                <th scope="col">GRADO</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $estudiantes as $estudiante )
            <tr>
                <td>{{ $estudiante->id }}</td>
                <td>{{ $estudiante->dni }}</td>
                <td>{{ $estudiante->nombres }}</td>
                <td>{{ $estudiante->apellidos }}</td>
                <td>{{ $estudiante->grado_seccion->grado_seccion }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ url('/estudiante/'.$estudiante->id.'/edit') }}">Editar</a>
                    <!-- convierte la petición de post a delete -->
                    <form class="d-inline" action="{{ url('/estudiante/'.$estudiante->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro de eliminar el estudiante?');" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $estudiantes->links() !!}
    <div>
        @endsection('content')