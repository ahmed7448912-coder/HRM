<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="card-body">
        <p class="text-secondary mb-4">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>
    </div>

    <div class="card-footer">
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-warning text-dark">{{ __('Update Password') }}</button>
            @if (session('status') === 'password-updated')
                <span class="text-success small animated fadeOut">
                    <i class="bi bi-check-circle-fill me-1"></i> {{ __('Saved successfully.') }}
                </span>
            @endif
        </div>
    </div>
</form>


