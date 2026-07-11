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
            
            @if (Auth::id() === $user->id)
                <div>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-light">⚙️ Edit Profile</a>
                </div>
            @endif
            
        </div>
        
        <ul class="nav nav-tabs bg-dark border-start border-end px-3 pt-2" id="profileTabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#home" type="button">
                    Home
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shinyshowcase" type="button">
                    Shiny Showcase
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#posts" type="button">
                    Posts
                </button>
            </li>
        </ul>
        
        <div class="tab-content bg-dark border border-top-0 rounded-bottom p-4 text-white">
            <div class="tab-pane fade show active" id="home">
                <h2 class="fw-bold text-poke-gold">{{ $user->username }}'s Description</h2>
                <p>{{ $user->description ?? 'This user doesnt have description yet' }}</p>
            </div>
            <div class="tab-pane fade" id="shinyshowcase">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="fw-bold text-poke-gold">{{ $user->username }}'s Shiny Showcase</h2>
                    
                    @if (Auth::id() === $user->id)
                        <a href="{{ route('shiny.create') }}" class="btn btn-warning shadow-sm fw-bold">Add Shiny</a>
                    @endif
                </div>
                <hr class="border-secondary my-3">
                <div class="row">
                    @foreach ($userShinies as $shiny)
                        <div class="col-md-2 mb-4">
                            <div class="card bg-dark h-100 border-warning" data-bs-toggle="modal" data-bs-target="#shinyModal{{ $loop->index }}">
                                <img src="https://img.pokemondb.net/sprites/black-white/shiny/{{ Str::lower($shiny->pokemon_name) }}.png" alt="Sprite">
                            </div>
                        </div>
                        <div class="modal fade" id="shinyModal{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-dark text-poke-light">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-poke-light fw-bold" id="exampleModalLabel">{{ $shiny->pokemon_name }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col d-flex justify-content-center align-items-center">
                                            <img src="https://img.pokemondb.net/sprites/black-white/shiny/{{ Str::lower($shiny->pokemon_name) }}.png" alt="Shiny {{ $shiny->pokemon_name }} Sprite">
                                        </div>
                                        <div class="col pe-4">
                                            <div class="border border-warning rounded text-poke-light h-100 py-3">
                                                <div class="text-center p-2">
                                                    <span class="text-poke-light">Nature: {{ $shiny->nature ?? '-' }}</span>
                                                </div>
                                                <hr class="border-secondary">
                                                @foreach ($ivStats as $field => $label)
                                                    <div class="d-flex justify-content-center p-2"> 
                                                        <span class="me-3">{{ $label }}:</span>
                                                        <span class="{{ $shiny->getIvColor($shiny->$field) }}">
                                                            {{ $shiny->$field ?? '-' }}
                                                        </span>                                          
                                                    </div>
                                                    @if (!$loop->last)
                                                        <hr class="border-secondary">
                                                    @endif  
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger fw-bold shadow-sm" data-bs-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="posts">
                <h2>s</h2>
            </div>
        </div>
    </div>
@endsection