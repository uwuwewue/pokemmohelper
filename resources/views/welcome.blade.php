@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-3 fw-bold text-poke-gold">PokeMMO Helper</h1>
            <p class="lead text-poke-light mt-3">
                Level up your PokeMMO journey. Keep track of your daily catches, connect with fellow trainers, and join top-tier guilds all in one place.
            </p>
            
            <div class="mt-5">
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4">Login</a>
                <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-4 me-md-3 fw-bold">Register</a>
            </div>
        </div>
    </div>
</div>
@endsection