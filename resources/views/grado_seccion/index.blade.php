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

    <a class="btn btn-success mb-2" href="{{url('grado-seccion/create')}}">Registrar nuevo grado sección</a>

    <table class="table table-striped table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">GRADO & SECCIÓN</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $grados as $grado )
            <tr>
                <td>{{ $grado->grado_seccion }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ url('/grado-seccion/'.$grado->id.'/edit') }}">Editar</a>
                    <form class="d-inline" action="{{ url('/grado-seccion/'.$grado->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro de eliminar el grado?');" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        @endsection('content')