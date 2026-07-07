@extends('layouts.app')

@section('content')
<div class="container mt-5 text-poke-light">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            
            <div class="bg-poke-dark p-4 rounded border border-warning mb-4 shadow">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-poke-dark p-4 rounded border border-warning mb-4 shadow">
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-poke-dark p-4 rounded border border-warning shadow">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</div>
@endsection