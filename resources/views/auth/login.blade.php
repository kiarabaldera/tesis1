@extends('layouts.app')

@section('content')
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header text-center font-weight-bold">{{ __('Inicio de sesión') }}</h3>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="pr-3 pl-3 pb-3">
                        @csrf
                        <figure class="text-center"> <img src="{{ asset('storage/img/logo.png')}}" alt="logo" width="150" height="150"></figure>
                        <div class="form-group">
                            <label for="username" class="form-label">Correo</label>
                            <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username" autofocus aria-describedby="usernameHelp">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-success w-100">
                                {{ __('Iniciar Sesión') }}
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection