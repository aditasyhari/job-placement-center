@extends('layouts.loginreg')
@section('title')
<title>Register | Job Placement Center</title>
@endsection

@section('css')
<style>
    input[type="radio"]{
    -webkit-appearance: radio;
    }
</style>
@endsection

@section('content')
<div class="card2 card border-0 px-4 py-5">
    <div class="row mb-4 px-3">
        <h6 class="mb-0 mr-4 mt-2 text-uppercase">Register</h6>
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
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row px-3">
            <label class="mb-1">
                <h6 class="mb-0 text-sm">Username</h6>
            </label>
            <input class="mb-4 @error('name') is-invalid @enderror" type="text" name="name" placeholder="Username">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row px-3">
            <label class="mb-1">
                <h6 class="mb-0 text-sm">Email</h6>
            </label>
            <input class="mb-4 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email">
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
            <input type="password" class="mb-4 @error('password') is-invalid @enderror" name="password" placeholder="Masukkan password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row px-3">
            <label class="mb-1">
                <h6 class="mb-0 text-sm">Repeat Password</h6>
            </label>
            <input type="password" class="mb-4 @error('password_confirmation') is-invalid @enderror" placeholder="Ulangi password" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- <label>Daftar Sebagai?</label><hr> -->
        <div class="row px-3 mb-4">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="role" class="custom-control-input" value="2" checked>
                <label class="custom-control-label" for="customRadioInline1">Alumni</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="role" class="custom-control-input" value="3">
                <label class="custom-control-label" for="customRadioInline2">Perusahaan</label>
            </div>
        </div>
    
        <div class="row mb-3 px-3">
            <button type="submit" class="btn btn-blue text-center">Register</button>
        </div>
        <div class="row mb-4 px-3">
            <small class="font-weight-bold">Do have an account?
                <a class="text-danger" href="{{ route('login') }}">Login</a>
            </small>
        </div>
    </form>
</div>
@endsection