@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="border border-bottom-0 p-5 bg-dark rounded-top d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-4">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->username }} avatar" class="rounded-circle border border-warning shadow" style="width: 100px; height: 100px; object-fit: cover;">
                @else
                    <div class="rounded-circle border border-warning shadow d-flex align-items-center justify-content-center bg-poke-dark text-poke-gold" style="width: 100px; height: 100px; font-size: 2.5rem; font-weight: bold;">
                        {{ strtoupper(substr($user->username, 0, 1)) }}
                    </div>
                @endif
                <h2 class="text-white m-0">{{ $user->username }}</h2>                
            </div>
            
            
            @if (auth()->check() && auth()->user()->id === $user->id)
                <div>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-light">⚙️ Edit Profile</a>
                </div>
            @endif
            
        </div>
        
        <ul class="nav nav-tabs bg-dark border-start border-end px-3 pt-2" id="profileTabs">
            <li class="nav-item">
                <button class="nav-link active bg-dark text-white border-secondary border-bottom-0" data-bs-toggle="tab" data-bs-target="#home" type="button">
                    Home
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-secondary border-0" data-bs-toggle="tab" data-bs-target="#shinyshowcase" type="button">
                    Shiny Showcase
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-secondary border-0" data-bs-toggle="tab" data-bs-target="#posts" type="button">
                    Posts
                </button>
            </li>
        </ul>
        
        <div class="tab-content bg-dark border border-top-0 rounded-bottom p-4 text-white">
            <div class="tab-pane fade show active" id="home">
                <p>{{ $user->description ?? 'This user doesnt have description yet' }}</p>
            </div>
            <div class="tab-pane fade" id="shinyshowcase">
                <h2>Shiny Showcase</h2>
                <p>some shinies</p>
            </div>
            <div class="tab-pane fade" id="posts">
                <h2>s</h2>
            </div>
        </div>
    
    </div>
@endsection