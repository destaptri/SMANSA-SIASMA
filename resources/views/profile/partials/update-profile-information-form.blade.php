<section class="profile-section">
    <header>
        <h2 class="profile-section-title">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="profile-section-subtitle">
            {{ __("Perbarui informasi profil akun dan alamat email anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="profile-form-group">
            <label for="name" class="profile-form-label">{{ __('Nama Lengkap') }}</label>
            <input id="name" name="name" type="text" class="profile-form-input" value="{{ old('name', $user->name) }}" required autocomplete="name" />
            <span class="profile-error-message">
                @if ($errors->get('name'))
                    {{ $errors->get('name')[0] }}
                @endif
            </span>
        </div>

        <div class="profile-form-group">
            <label for="email" class="profile-form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="profile-form-input" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <span class="profile-error-message">
                @if ($errors->get('email'))
                    {{ $errors->get('email')[0] }}
                @endif
            </span>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="profile-verification-message">
                        {{ __('Email anda belum terverifikasi.') }}

                        <button form="send-verification" class="profile-btn-link">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="profile-success-message">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="profile-form-actions">
            <button type="submit" class="profile-btn profile-btn-primary">{{ __('Simpan') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="profile-status-message">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
