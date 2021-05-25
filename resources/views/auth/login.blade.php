@extends('layouts.loginreg')
@section('title')
<title>Log in | Job Placement Center</title>
@endsection

@section('content')
<div class="card2 card border-0 px-4 py-5">
    <div class="row mb-4 px-3">
        <h6 class="mb-0 mr-4 mt-2 text-uppercase">Log in</h6>
        <!-- <div class="facebook text-center mr-3">
            <div class="fa fa-facebook"></div>
        </div>
        <div class="twitter text-center mr-3">
            <div class="fa fa-twitter"></div>
        </div>
        <div class="linkedin text-center mr-3">
            <div class="fa fa-linkedin"></div>
        </div> -->
    </div>
    <div class="row px-3 mb-4">
        <!-- <div class="line"></div> <small class="or text-center">Or</small> -->
        <div class="line"></div>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="row px-3">
            <label class="mb-1">
                <h6 class="mb-0 text-sm">Email</h6>
            </label>
            <input class="mb-4 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Masukkan Email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row px-3">
            <label class="mb-1">
                <h6 class="mb-0 text-sm">Password</h6>
            </label>
            <input type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Masukkan Password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row px-3 mb-4">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input id="remember" type="checkbox" name="remember" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="custom-control-label text-sm">Remember me</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="ml-auto mb-0 text-sm">Forgot Password?</a>
            @endif
        </div>
    
        <div class="row mb-3 px-3">
            <button type="submit" class="btn btn-blue text-center">Login</button>
        </div>
        <div class="row mb-4 px-3">
            <small class="font-weight-bold">Don't have an account?
                <a class="text-danger" href="{{ route('register') }}">Register</a>
            </small>
        </div>
    </form>
</div>
@endsection