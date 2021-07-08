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


    <a class="btn btn-success mb-2" href="{{url('grado/create')}}">Registrar nuevo grado</a>

    <table class="table table-striped table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">GRADO</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $grados as $grado )
            <tr>
                <td>{{ $grado->descripcion }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ url('/grado/'.$grado->id.'/edit') }}">Editar</a>
                    <!-- convierte la petición de post a delete -->
                    <form class="d-inline" action="{{ url('/grado/'.$grado->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro de eliminar el grado?');" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $grados->links() !!}
    <div>
        @endsection('content')