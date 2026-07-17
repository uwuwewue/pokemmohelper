@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark border-secondary text-poke-light shadow">
                <div class="card-header border-secondary text-warning fw-bold fs-5">
                    Create Recruitment Post
                </div>
                <div class="card-body">
                    <form action="{{ route('recruitment.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="team_name" class="form-label">Team Name</label>
                            <input type="text" class="form-control form-control-poke bg-dark text-poke-light border-secondary @error('team_name') is-invalid @enderror" id="team_name" name="team_name" value="{{ old('team_name') }}" required>
                            @error('team_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="playstyle" class="form-label">Playstyle (e.g., PvP, PvE, Casual, Tryhard)</label>
                            <input type="text" class="form-control form-control-poke @error('playstyle') is-invalid @enderror" id="playstyle" name="playstyle" value="{{ old('playstyle') }}" placeholder="What kind of players are you looking for?" required>
                            @error('playstyle') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="requirements" class="form-label">Requirements</label>
                            <textarea class="form-control form-control-poke @error('requirements') is-invalid @enderror" id="requirements" name="requirements" rows="3" required>{{ old('requirements') }}</textarea>
                            @error('requirements') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control form-control-poke @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('recruitment.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-warning fw-bold">Post Recruitment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection