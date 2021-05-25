@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        Welcome Mr. {{Auth()->user()->name}}
                    {{ __('You are The Admin!') }} <br>
                    {{-- <a href="{{url()->to('admin/test')}}" method="get"> <button class="btn btn-primary">View Details</button></a> --}}
                    <a href="{{route('A-details')}}"> <button class="btn btn-primary">View Details</button></a>
                    {{-- <a href="{{url()->to('admin/get-details')}}" method="get"> <button class="btn btn-primary">View Details</button></a> --}}
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
