@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{ url('/grado-seccion/'.$grado->id)}}" method="post" enctype="multipart/form-data">
        <!-- Crea llave de seguridad para que la data del form viene del mismo sistema -->
        @csrf
        {{ method_field('PATCH') }}
        <!-- pasar un dato mediante el include -->
        @include('grado_seccion.form',['modo'=>'Editar']);
    </form>

    <div>
        @endsection('content')