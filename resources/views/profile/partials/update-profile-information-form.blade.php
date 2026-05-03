<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <!--begin::Body-->
    <div class="card-body">
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email address') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" aria-describedby="emailHelp" required autocomplete="username" />
            <div id="emailHelp" class="form-text">
                {{ __("We'll never share your email with anyone else.") }}
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-dark">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="btn btn-link p-0 align-baseline">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success mt-2">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="input-group mb-3">
            <input type="file" name="profile_photo" class="form-control" id="profilePhotoUpload" />
            <label class="input-group-text" for="profilePhotoUpload">{{ __('Upload Photo') }}</label>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="updateNotification" checked />
            <label class="form-check-label" for="updateNotification">{{ __('Keep my profile updated') }}</label>
        </div>
    </div>
    <!--end::Body-->

    <!--begin::Footer-->
    <div class="card-footer">
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">{{ __('Submit Changes') }}</button>
            @if (session('status') === 'profile-updated')
                <span class="text-success small animated fadeOut">
                    <i class="bi bi-check-circle-fill me-1"></i> {{ __('Saved successfully.') }}
                </span>
            @endif
        </div>
    </div>
    <!--end::Footer-->
</form>



