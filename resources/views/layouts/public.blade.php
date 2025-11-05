
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">

    {!! $metaTags ?? '' !!}

    <!-- Structured Data -->
    {!! App\Helpers\SEOHelper::organizationSchema() !!}

    <!-- Scripts and Styles via Vite -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <!-- Logo -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ url('images/logo.png') }}" alt="{{ config('app.name') }}" class="navbar-logo me-2" onerror="this.style.display='none'">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="main-nav">
                <ul class="navbar-nav ms-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services.index') ? 'active' : '' }}" href="{{ route('services.index') }}">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('projects.index') ? 'active' : '' }}" href="{{ route('projects.index') }}">Proyek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-2"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-edit me-2"></i>{{ __('Profile') }}
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         this.closest('form').submit();">
                                            <i class="fas fa-sign-out-alt me-2"></i>{{ __('Log Out') }}
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="btn btn-primary me-2">{{ __('Register') }}</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">{{ __('Login') }}</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark text-white pt-5 pb-4">
        <div class="container text-center text-md-start">
            <div class="row text-center text-md-start">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-info">{{ config('app.name', 'PT. Nusuki Mega Utama') }}</h5>
                    <p>Menyediakan solusi konstruksi dan renovasi terbaik untuk properti Anda. Kualitas dan kepuasan pelanggan adalah prioritas kami.</p>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-info">Navigasi</h5>
                    <p><a href="{{ route('about') }}" class="text-white">Tentang Kami</a></p>
                    <p><a href="{{ route('services.index') }}" class="text-white">Layanan</a></p>
                    <p><a href="{{ route('projects.index') }}" class="text-white">Proyek</a></p>
                    <p><a href="{{ route('contact') }}" class="text-white">Kontak</a></p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-info">Kontak</h5>
                    <p><i class="bi bi-geo-alt-fill me-3"></i>
                        Jakarta: JL. Raya Pos Pengumben No.1
                    </p>
                    <p><i class="bi bi-telephone-fill me-3"></i>
                        <strong>Pusat:</strong> <a href="tel:081212084150" class="text-white">0812-1208-4150</a>
                    </p>
                    <p><i class="bi bi-telephone-fill me-3"></i>
                        <strong>Cabang Tangerang:</strong>
                        <a href="tel:081285106668" class="text-white">0812-8510-6668</a>
                        /
                        <a href="tel:0895357856136" class="text-white">0895-3578-56136</a>
                    </p>
                    <p><i class="bi bi-envelope-fill me-3"></i>
                        <a href="mailto:lukmanlucan68@gmail.com" class="text-white">lukmanlucan68@gmail.com</a>
                    </p>
                </div>
            </div>

            <hr class="mb-4">

            <div class="row align-items-center">
                <div class="col-md-7 col-lg-8">
                    <p> &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="text-center text-md-end">
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
