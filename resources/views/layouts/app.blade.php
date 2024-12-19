<!DOCTYPE html>
<html lang="en" data-theme="{{ $_COOKIE['theme'] ?? 'light' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'LeaseMaster')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">BrandName</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Navigation Links -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.logout') }}">Logout</a>
                        </li>
                    @endauth

                    <!-- Theme Toggle Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="themeDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-sun-fill"></i> <!-- Fancy Icon -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="themeDropdown">
                            <li class="px-3 py-2">
                                <div class="d-flex align-items-center">
                                    <span class="me-2">Light</span>
                                    <label class="theme-switch">
                                        <input type="checkbox" id="theme-switch">
                                        <span class="slider"></span>
                                    </label>
                                    <span class="ms-2">Dark</span>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="theme-guide d-none" id="themeGuide">
        <div class="card shadow-sm">
            <div class="card-body position-relative">
                <div class="pointer"></div>
                <h5 class="card-title">Switch Theme</h5>
                <p class="card-text mb-2">
                    Click the <i class="bi bi-sun-fill"></i> icon above to toggle between Light and Dark mode!
                </p>
                <button class="btn btn-primary btn-sm dismiss-guide">Got it!</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/color-theme.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <div>
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer text-white py-3">
        <div class="container text-center">
            <p>&copy; 2024 LeaseMaster. All Rights Reserved.</p>
        </div>
    </footer>

</body>

</html>
