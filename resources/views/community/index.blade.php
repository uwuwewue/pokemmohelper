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
                <h3 class="text-poke-gold fw-bold">Latest Posts</h3>
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
                                    @auth
                                        @if (Auth::id() === $post->user_id)
                                            <div class="dropdown">
                                            <button class="btn btn-link text-poke-light p-0 fs-4 lh-1 border-0" type="button" id="dropdownMenuButton-{{ $post->id }}" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                                                ...
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end bg-dark text-poke-light text-center border-warning">
                                                <li>
                                                    <form action="{{ route('community.destroy', $post->id) }}" method="POST" class="delete-post-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item btn bg-transparent text-poke-light mt-2">Delete</button>
                                                    </form>
                                                </li>
                                                <hr class="border border-secondary">
                                                <li>
                                                    <button type="button" class="dropdown-item btn bg-transparent text-poke-light mb-2" data-bs-toggle="modal" data-bs-target="#editModal-{{ $post->id }}">
                                                        Edit
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                    @endauth
                                    <span class="small">{{ $post->created_at->diffForHumans() }}</span>                              
                                </div>
                            </div>
                            <hr class="border border-secondary">
                            <p class="card-text">{!! nl2br(e($post->content)) !!}</p>
                            <hr class="border border-secondary">
                            @if ($post->image_path)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post image" class="img-fluid rounded border border-secondary" style="max-height: 250px; width: 250px; object-fit: cover;">
                                </div>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent border-secondary border-top d-flex justify-content-start py-2">
                            <button class="btn btn-sm btn-outline-warning border-0 like-btn" data-id="{{ $post->id }}">
                                <i class="fa-heart {{ Auth::check() && $post->isLikedBy(Auth::user()) ? 'fas text-danger' : 'far text-light' }} like-icon fs-5"></i> 
                                <span class="likes-count fw-bold ms-1 fs-5 text-light">{{ $post->likes()->count() }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal fade" id="editModal-{{ $post->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $post->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark text-poke-light border-warning">
                                <div class="modal-header border-secondary">
                                    <h5 class="modal-title fw-bold" id="editModalLabel-{{ $post->id }}">Edit Post</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                <form action="{{ route('community.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') 
                                    
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label text-poke-light small">Post content</label>
                                            <textarea class="form-control text-light" style="background-color: #2b2b2b; border-color: #444;" name="content" rows="4" required>{{ $post->content }}</textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label text-poke-light small">Change image (optional)</label>
                                            <input class="form-control bg-dark text-light border-secondary" type="file" name="image" accept="image/*">
                                            @if($post->image_path)
                                                <small class="text-muted d-block mt-1">Note: Uploading a new image will replace the current one.</small>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer border-secondary">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-warning fw-bold text-dark">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center my-4 dark-pagination">
                    {{ $posts->links() }}
                </div>
                @if ($posts->isEmpty())
                    <div class="border border-danger text-center bg-light p-4">
                        <h6 class="fw-bold">No posts yet. Be the first one to post!</h6>
                    </div>
                @endif
        </div>
    </div>
</div>
@endsection
