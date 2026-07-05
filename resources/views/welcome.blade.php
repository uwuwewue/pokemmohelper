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

            <!-- Features -->
            <div class="row mt-5">
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm bg-transparent text-white border-warning">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Interactive Pokedex</h5>
                            <hr class="my-3 text-secondary">
                            <p class="lead card-text">Track your catches, filter by region, and complete your ultimate OT Dex.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm bg-transparent text-white border-warning">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Strategy Guides</h5>
                            <hr class="my-3 text-secondary">
                            <p class="lead card-text">Discover top breeding routes, EV spots, and money-making methods from veterans.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm bg-transparent text-white border-warning">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Community Hub</h5>
                            <hr class="my-3 text-secondary">
                            <p class="lead card-text">Share your shiny catches, discuss the PvP meta, and trade with others.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm bg-transparent text-white border-warning">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Team Recruitment</h5>
                            <hr class="my-3 text-secondary">
                            <p class="lead card-text">Find the perfect guild or recruit top-tier trainers for your own team.</p>
                        </div>
                    </div>
                </div>
                
            </div>
            

        </div>

    </div>
</div>
@endsection