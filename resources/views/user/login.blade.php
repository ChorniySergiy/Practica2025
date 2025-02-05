@extends('layouts.main')

@section('title', 'Home page')

@section('content')
    <h1>{{ __('messages.login_page') }}</h1>

    <form action="{{ route('login.auth') }}" method="post">
    @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email"
            class="form-control" id="email" placeholder="Email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('messages.password') }}</label>
            <input name="password" type="password"
            class="form-control"
            id="password" placeholder="Password">
        </div>

        <div class="mb-3 form-check">
            <input name="remember" class="form-check-input" 
            type="checkbox" id="remember">
            <label class="form-check-label" for="remember">
            {{ __('messages.Запамятати мене') }}
            </label>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.login_go') }}</button>
        
        <a href="{{ route('password.request') }}" class="ms-2">{{ __('messages.forgot_password') }}</a>

    </form>

@endsection