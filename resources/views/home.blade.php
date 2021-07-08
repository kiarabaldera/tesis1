@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body text-center">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                {{ __('Bienvenido al sistema') }}
            </div>
        </div>
    </div>
</div>
@endsection