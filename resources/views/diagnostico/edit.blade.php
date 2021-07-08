@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{url('/diagnostico/'.$diagnostico->id)}}" method="post" enctype="multipart/form-data">
        <!-- Crea llave de seguridad para que la data del form viene del mismo sistema -->
        @csrf
        {{ method_field('PATCH') }}
        @include('diagnostico.form',['modo'=>'Editar']);

    </form>

    <div>
        @endsection('content')