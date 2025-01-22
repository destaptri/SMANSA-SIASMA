<section class="profile-section col-lg-12 col-sm-12">
    <header>
        <h2 class="profile-section-title">Ubah Password</h2>
        <p class="profile-section-subtitle">Demi keamanan akun, perbarui kata sandi Anda secara berkala.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="profile-form-group">
            <label for="update_password_current_password" class="profile-form-label">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="profile-form-input" autocomplete="current-password" />
            <span class="profile-error-message">
                @if ($errors->updatePassword->get('current_password'))
                    {{ $errors->updatePassword->get('current_password')[0] }}
                @endif
            </span>
        </div>

        <div class="profile-form-group">
            <label for="update_password_password" class="profile-form-label">Password Baru</label>
            <input id="update_password_password" name="password" type="password" class="profile-form-input" autocomplete="new-password" />
            <span class="profile-error-message">
                @if ($errors->updatePassword->get('password'))
                    {{ $errors->updatePassword->get('password')[0] }}
                @endif
            </span>
        </div>

        <div class="profile-form-group">
            <label for="update_password_password_confirmation" class="profile-form-label">Konfirmasi Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="profile-form-input" autocomplete="new-password" />
            <span class="profile-error-message">
                @if ($errors->updatePassword->get('password_confirmation'))
                    {{ $errors->updatePassword->get('password_confirmation')[0] }}
                @endif
            </span>
        </div>

        <div class="profile-form-actions">
            <button type="submit" class="profile-btn profile-btn-primary" style="padding:7px 20px">Simpan</button>
            @if (session('status') === 'password-updated')
                <p class="profile-status-message">Saved.</p>
            @endif
        </div>
    </form>
</section>
