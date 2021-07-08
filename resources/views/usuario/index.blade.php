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


    <a class="btn btn-success mb-2" href="{{url('usuario/create')}}">Registrar nuevo usuario</a>

    <table class="table table-striped table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">USUARIO</th>
                <th scope="col">COLABORADOR</th>
                <th scope="col">ROL</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $usuarios as $usuario )
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->username }}</td>
                <td>{{ $usuario->colaborador_id }}</td>
                <td>{{ $usuario->rol->descripcion }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ url('/usuario/'.$usuario->id.'/edit') }}">Editar</a>
                    <!-- convierte la petición de post a delete -->
                    <form class="d-inline" action="{{ url('/usuario/'.$usuario->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro de eliminar al usuario?');" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $usuarios->links() !!}
    <div>
        @endsection('content')