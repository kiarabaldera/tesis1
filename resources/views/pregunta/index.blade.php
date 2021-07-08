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

    <a class="btn btn-success mb-2" href="{{url('pregunta/create')}}">Registrar nueva pregunta</a>

    <table class="table table-striped table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">PREGUNTA</th>
                <th scope="col">CATEGORÍA</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $preguntas as $pregunta )
            <tr>
                <td>{{ $pregunta->id }}</td>
                <td>{{ $pregunta->descripcion }}</td>
                <td>{{ $pregunta->categoria->descripcion }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ url('/pregunta/'.$pregunta->id.'/edit') }}">Editar</a>
                    <!-- convierte la petición de post a delete -->
                    <form class="d-inline" action="{{ url('/pregunta/'.$pregunta->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro de eliminar la pregunta?');" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $preguntas->links() !!}
    <div>
        @endsection('content')