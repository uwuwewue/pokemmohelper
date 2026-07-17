@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="position-relative d-flex justify-content-center align-items-center text-poke-gold fw-bold mb-3">
            <h2>Recruitment Board</h2>
            <a href="{{ route('recruitment.create') }}" class="btn btn-warning fw-bold p-2 position-absolute end-0">Create Post</a>
        </div>
    </div>

    <div class="row m-3 g-4">
        @forelse ($recruitments as $recruitment)
            <div class="col-md-4">
                <div class="card bg-dark border-warning text-poke-light h-100">
                    <div class="card-header border-bottom border-warning text-center">
                        <h4 class="mt-1 fw-bold">{{ $recruitment->team_name }}</h4>
                    </div>

                    <div class="card-body border-bottom border-warning">
                        <h5 class="fw-bold">Playstyle</h5>
                        <p>{{ $recruitment->playstyle }}</p>

                        <hr class="border-warning opacity-100 my-3">

                        <h5 class="fw-bold">Requirements</h5>
                        <p>{!! nl2br(e($recruitment->requirements)) !!}</p>

                        <hr class="border-warning opacity-100 my-3">

                        <h5 class="fw-bold">Description</h5>
                        <p class="mb-0">{!! nl2br(e($recruitment->description)) !!}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center text-center p-3">
                        <p class="mb-0">Posted by <a href="{{ route('profile.show', $recruitment->user->username) }}" class="text-decoration-none text-poke-light fw-bold">{{ $recruitment->user->username }}</a></p>
                        <p class="mb-0 text-secondary small">{{ $recruitment->created_at->diffForHumans() }}</p>
                    </div>
                    @if(auth()->id() === $recruitment->user_id)
                        <div class="m-3 d-flex gap-2">
                            <a href="{{ route('recruitment.edit', $recruitment) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            
                            <form action="{{ route('recruitment.destroy', $recruitment) }}" method="POST" class="d-inline delete-post-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12 mt-4">
                <div class="border border-danger text-center bg-light p-4">
                    <h6 class="fw-bold mb-0">No posts yet. Be the first one to post!</h6>
                </div>
            </div>
        @endforelse
        <div class="d-flex justify-content-center my-4 dark-pagination">
            {{ $recruitments->links() }}
        </div>
    </div>
@endsection