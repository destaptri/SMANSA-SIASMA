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
            <button type="submit" class="profile-btn profile-btn-primary" style="padding:7px 20px" onclick="showSuccessPopup(event)">Simpan</button>
        </div>
    </form>
</section>
@if (session('status') === 'password-updated')
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Password Berhasil Diubah',
                    text: 'Silakan gunakan password baru saat login.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            };
        </script>
    @endif