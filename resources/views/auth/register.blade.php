@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de usuario') }}</div>
                <div class="card-body">
                    @if (isset($modo) && $modo == "Editar")
                    <form action="{{ url('/usuario/'.$usuario->id )}}" method="post" enctype="multipart/form-data">
                    <!-- Crea llave de seguridad para que la data del form viene del mismo sistema -->
                        @csrf
                    {{ method_field('PATCH') }}
                    @else
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                    @endif
                        <div class="form-group row">
                            <label for="colaborador_id" class="col-md-4 col-form-label text-md-right">{{ __('Colaborador') }}</label>
                            <div class="col-md-6">
                                <select value="{{isset($usuario->colaborador_id) ? $usuario->colaborador_id : old('colaborador_id')}} autofocus autocomplete=" colaborador_id" required name="colaborador_id" id="colaborador_id" class="custom-select @error('colaborador_id') is-invalid @enderror">
                                    <option required value="">Seleccionar colaborador</option>
                                    @foreach($colaboradores as $colaborador)
                                    <option value="{{ $colaborador->id }}" {{ isset($usuario->colaborador_id) && $colaborador->id == $usuario->colaborador_id ? 'selected' : '' }}>{{ $colaborador->nombres .' '. $colaborador->apellidos }}</option>
                                    @endforeach
                                </select>
                                @error('colaborador_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rol_id" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>
                            <div class="col-md-6">
                                <select value="{{isset($usuario->rol_id) ? $usuario->rol_id : old('rol_id')}} autocomplete=" rol_id" required name="rol_id" id="rol_id" class="custom-select @error('rol_id') is-invalid @enderror">
                                    <option required value="">Seleccionar rol</option>
                                    @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}" {{ isset($usuario->rol_id) && $rol->id == $usuario->rol_id ? 'selected' : '' }}>{{ $rol->descripcion }}</option>
                                    @endforeach
                                </select>
                                @error('rol_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{isset($usuario->username) ? $usuario->username : old('username')}}" required autocomplete="username">
                                @error('Usuario')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('Contraseña')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input class="btn btn-success" type="submit" value="{{$modo}} datos">
                                <a class="btn btn-primary" href="{{url('usuario')}}">Regresar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection