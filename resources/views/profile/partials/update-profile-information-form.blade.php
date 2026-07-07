<section>
    <header class="mb-4">
        <h2 class="h4 text-poke-light">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-poke-light small">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}" enctype="multipart/form-data">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }} " enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="username" class="form-label text-poke-light">{{ __('Username') }}</label>
            <input type="text" id="username" name="username" class="form-control form-control-poke bg-dark text-poke-light" value="{{ old('username', $user->username) }}" required autofocus autocomplete="username">
            @error('username')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label text-poke-light">{{ __('Description') }}</label>
            <textarea id="description" name="description" class="form-control form-control-poke bg-dark text-poke-light" rows="4">{{ old('description', $user->description) }}</textarea>
            @error('description')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="avatar" class="form-label text-poke-light">{{ __('Avatar') }}</label>
            @if ($user->avatar)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar" class="rounded-circle border border-warning" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
            @endif
            <input type="file" id="avatar" name="avatar" class="form-control form-control-poke" accept="image/*">
            @error('avatar')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label text-white">{{ __('Email') }}</label>
            <input type="email" id="email" name="email" class="form-control form-control-poke bg-dark text-poke-light" value="{{ old('email', $user->email) }}" required autocomplete="email">
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-warning small mb-1">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-link p-0 text-warning text-decoration-underline shadow-none">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success small fw-bold mt-2">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-poke-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success small mb-0"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>