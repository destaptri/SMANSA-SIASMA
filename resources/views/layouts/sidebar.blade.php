<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link href="resources/css/styles.css" rel="stylesheet" />
    <link href="resources/css/sidebar.css" rel="stylesheet" />

    @vite([
    'resources/css/app.css',
    'resources/css/styles.css',
    'resources/css/sidebar.css'
    ])
</head>

<body>
    <div class="wrapper d-flex">
        <!-- Sidebar -->
        <nav class="sidebar flex-column bg-white position-sticky">
            <div class="sidebar-header p-3 d-flex align-items-center">
                <img src="{{ Vite::asset('public/images/logo.png') }}" alt="Logo" class="logo me-3">
                <div>
                    <span class="brand-name d-block">SIASMA</span>
                    <span class="brand-subtitle">SISTEM INFORMASI ALUMNI<br>SMAN 1 PONTIANAK</span>
                </div>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link mt-2.5 {{ Route::currentRouteName() === 'admin.menu' ? 'active' : '' }}" href="{{ route('admin.menu') }}">
                        <i class="bi bi-grid"></i> MENU
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() === 'pencarian-data' ? 'active' : '' }}" href="{{ route('pencarian-data') }}">
                        <i class="bi bi-people-fill"></i> Data Alumni
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() === 'antrian-validasi' ? 'active' : '' }}" href="{{ route('antrian-validasi') }}">
                        <i class="bi bi-check2-circle"></i> Validasi Data Alumni
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() === '' ? 'active' : '' }}" href="#">
                        <i class="bi bi-newspaper"></i> Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() === 'admin.laporan' ? 'active' : '' }}" href="{{ route('admin.laporan') }}">
                        <i class="bi bi-file-earmark-text"></i> Laporan
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>


        <div class="container-fluid flex-column ml-1">
            <div class="user-session ms-auto flex-row">
                <div class="dropdown">
                    <button
                        class="btn dropdown-toggle d-flex align-items-center justify-content-start gap-2" type="button" id="userSessionDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="padding-left: 45px;">
                        <i class="bi bi-person-circle" style="font-size: 24px; position: absolute; top: 50%; left: 20%; transform: translate(-40%, -50%);"></i> Admin
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userSessionDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="admin-content flex-row">
                <main>
                    @yield('content')
                </main>
            </div>

        </div>
    </div>



    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    @vite([
    'resources/js/script.js',
    'resources/js/sidebar.js',
    'resources/js/filter.js',
    'resources/js/alert.js'
    ])
</body>

</html>