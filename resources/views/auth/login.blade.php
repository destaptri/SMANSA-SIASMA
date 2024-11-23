<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <link href="resources/css/styles.css" rel="stylesheet"/>
    @vite([
            'resources/css/app.css',
            'resources/css/styles.css',
            ])
<style>
    body {
        background-color: #DEEBFE;
    }
</style>
</head>
<body>
<div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg navbar-light">
            <div class="d-flex align-items-center">
            <img src="{{ Vite::asset('public/images/logo.png') }}" alt="Logo" class="logo">
            <div>
                <span class="brand-name">SIASMA</span><br>
                <span class="brand-subtitle">SISTEM INFORMASI ALUMNI SMAN 1 PONTIANAK</span>
            </div>
            </div>
</nav>
</div>
<div class="login-page">
<!-- Login Form -->
<div class="login-container">
    <div class="login-box">
        <h2>LOGIN</h2>
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- NISN/NIP Input -->
                <label for="input_type">{{ __('NISN/NIP/Email') }}</label>
                <div class="email-container">
                    <input id="input_type" type="text" class="form-control" name="input_type" value="{{ old('input_type') }}" autocomplete="username" autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <x-input-error :messages="$errors->get('nisn')" class="mt-2" />
                <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                </div>
                

                <div class="links d-flex flex-row-reverse">
                    <a href="#">Lupa NISN/NIP?</a> 
                </div>

                <!-- Password Input -->
                <label for="password">{{ __('Password') }}</label>
                <div class="password-container">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                    <i class="fas fa-eye" id="togglePassword"></i>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                </div>

                @if (Route::has('password.request'))
                    <div class="links d-flex flex-row-reverse">
                        <a href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                    </div>
                @endif

                <!-- Remember Me Checkbox -->
                <div class="form-check d-flex align-items-center">
                    <input class="form-check-input me-2 mb-4 mt-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label mb-3 mt-0" for="remember" style="line-height: 1;">
                        {{ __('Ingat Saya') }}
                    </label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="login-button">
                    {{ __('Login') }}
                </button>

            </form>
    </div>
</div>
</div>
<!-- Bootstrap 5 JS Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS (Optional) -->
<script src="js/scripts.js"></script>
@vite([
        'resources/js/app.js',
        'resources/js/script.js'
])
</body>
</html>
