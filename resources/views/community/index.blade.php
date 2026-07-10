@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mt-3">
            <h1 class="text-poke-gold fw-bold mb-4">Community Tab</h1>
            
            @auth
                <div class="card shadow-sm mb-4 border-warning bg-dark text-poke-light">
                    <div class="card-body">
                        <form action="{{ route('community.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="content" class="form-label fw-bold">Hey {{ Auth::user()->username }}, post something!</label>
                                <textarea class="form-control form-control-poke text-poke-light" name="content" id="content" rows="4" required placeholder="What's on your mind?"></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="file" class="form-control form-control-poke" name="image" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-warning fw-bold px-3">Post</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-primary alert-dismissible shadow-sm mb-4" role="alert">
                    <p>You must be <a href="{{ route('login') }}" class="alert-link">logged in</a> to make a post.</p>
                </div>
            @endauth
            
                <hr class="border border-secondary">
                <h3 class="text-poke-gold fw-bold">Latest's Posts</h3>
                @foreach ($posts as $post)
                    <div class="card mb-3 border-warning bg-dark text-poke-light rounded">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $post->user->avatar ? asset('storage/' . $post->user->avatar) : 'https://ui-avatars.com/api/?name=' . $post->user->username . '&background=2b2b2b&color=ffc107' }}" 
                                        alt="Avatar" 
                                        class="rounded-circle me-3 border border-secondary" 
                                        style="width: 45px; height: 45px; object-fit: cover;">                                        
                                    <h5 class="mb-0">{{ $post->user->username }}</h5>
                                </div>
                                <div class="text-end">
                                    <span class="small">{{ $post->created_at->diffForHumans() }}</span>
                                    @auth
                                        @if (Auth::id() === $post->user_id)
                                            <form action="{{ route('community.destroy', $post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <hr class="border border-secondary">
                            <p class="card-text">{{ $post->content }}</p>
                            <hr class="border border-secondary">
                            @if ($post->image_path)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post image" class="img-fluid rounded border border-secondary" style="max-height: 250px; width: 250px; object-fit: cover;">
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                @if ($posts->isEmpty())
                    <div class="border border-danger text-center bg-light p-4">
                        <h6 class="fw-bold">No posts yet. Be the first one to post!</h6>
                    </div>
                @endif
        </div>
    </div>
</div>
@endsection
