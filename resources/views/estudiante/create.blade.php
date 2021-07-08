@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{url('/estudiante')}}" method="post" enctype="multipart/form-data">
        <!-- Crea llave de seguridad para que la data del form viene del mismo sistema -->
        @csrf
        @include('estudiante.form',['modo'=>'Crear']);

    </form>

    <div>
        @endsection('content')