@extends('layouts.app')

@section('content')
    <center>
        <p>Name: {{Auth()->user()->name}} </p>
        <p>Email: {{Auth()->user()->email}} </p>
        <p>Role: {{Auth()->user()->role}} </p>
    </center>

    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <form action="{{route('test.update',1)}}" method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <label for="name">Name: </label>
                            <input id="name" name="name" type="text">
                            <br>
                            <label for="add">Address: </label>
                            <input id="add" name="add" type="text">
                            <br>
                            <label for="phone">Phone: </label>
                            <input id="phone" name="phone" type="text">
                            <br>
                            <button class="btn-primary" type="submit">Save </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div> --}}
@endsection