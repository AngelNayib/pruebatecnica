@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-title">
                <h4>Autenticarse</h4>
            </div>
            @if (session('errors'))
                <div class="alert alert-danger">{{ session('errors') }}</div>
            @endif
            <div class="card-body">

                <form method="POST" action="{{ route('login.user') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required
                                autocomplete="new-password">


                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Iniciar Sesión') }}
                            </button>
                        </div>

                    </div>
                </form>
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary" onclick="window.location='{{ route('register') }}'">
                        {{ __('Registrarse') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
