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

    <table class="table table-striped table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">DNI</th>
                <th scope="col">NOMBRES</th>
                <th scope="col">APELLIDOS</th>
                <th scope="col">GRADO</th>
                <th scope="col">RESULTADO</th>
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
                <td>{{ $estudiante->grado_seccion }}</td>
                <td>{{ isset($estudiante->resultado) ? $estudiante->resultado : "sin test" }}</td>
                <td>
                    @if(isset($estudiante->resultado))
                    <!-- si hay resultado, entonces renderizar data de editar -->
                    <a class="btn btn-primary" href="{{ url('/diagnostico/'.$estudiante->id.'/edit') }}">Editar</a>
                    @else
                    <!-- si no hay, entonces mostrar para registrar -->
                    <a class="btn btn-success" href="{{url('/diagnostico/'.$estudiante->id.'/create')}}">Registrar</a>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $estudiantes->links() !!}
    <div>
        @endsection('content')