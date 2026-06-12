<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Lost and Found System' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --brand-ink: #14213d;
            --brand-gold: #f4a261;
            --brand-soft: #f8f4ec;
            --brand-sea: #2a9d8f;
            --brand-danger: #b00020;
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(244, 162, 97, 0.16), transparent 28%),
                linear-gradient(180deg, #fffaf3 0%, #f4f7fb 48%, #eef4f8 100%);
            color: #24324a;
            font-family: "Source Sans 3", sans-serif;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, .navbar-brand {
            font-family: "Space Grotesk", sans-serif;
        }

        .navbar-shell,
        .panel-card,
        .stat-card,
        .item-card,
        .hero-card {
            background: rgba(255, 255, 255, 0.86);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(20, 33, 61, 0.08);
            box-shadow: 0 18px 45px rgba(20, 33, 61, 0.08);
        }

        .navbar-shell {
            border-radius: 1.25rem;
        }

        .hero-card,
        .panel-card,
        .item-card,
        .stat-card {
            border-radius: 1.25rem;
        }

        .brand-mark {
            background: linear-gradient(135deg, var(--brand-gold), #e76f51);
            border-radius: 0.9rem;
            color: #fff;
            display: inline-flex;
            font-family: "Space Grotesk", sans-serif;
            font-size: 1rem;
            font-weight: 700;
            height: 2.6rem;
            justify-content: center;
            align-items: center;
            width: 2.6rem;
        }

        .hero-gradient {
            background: linear-gradient(135deg, rgba(20, 33, 61, 0.96), rgba(42, 157, 143, 0.88));
            color: #fff;
        }

        .btn-brand {
            background: linear-gradient(135deg, var(--brand-ink), #274c77);
            border: none;
            color: #fff;
        }

        .btn-brand:hover,
        .btn-brand:focus {
            color: #fff;
            background: linear-gradient(135deg, #0f1a31, #1e3f62);
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--brand-gold), #e76f51);
            border: none;
            color: #fff;
        }

        .btn-accent:hover,
        .btn-accent:focus {
            color: #fff;
            background: linear-gradient(135deg, #eb8d49, #d95b3c);
        }

        .text-brand {
            color: var(--brand-ink) !important;
        }

        .badge-soft {
            background: rgba(20, 33, 61, 0.08);
            color: var(--brand-ink);
        }

        .status-pill {
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            padding: 0.45rem 0.8rem;
            text-transform: uppercase;
        }

        .status-pending,
        .status-available {
            background: rgba(244, 162, 97, 0.18);
            color: #a2521c;
        }

        .status-matched {
            background: rgba(42, 157, 143, 0.18);
            color: #156f65;
        }

        .status-recovered,
        .status-returned {
            background: rgba(25, 135, 84, 0.18);
            color: #1f6b45;
        }

        .stat-kicker {
            color: #5b6880;
            font-size: 0.85rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .empty-state,
        .image-placeholder {
            align-items: center;
            background: linear-gradient(135deg, rgba(20, 33, 61, 0.06), rgba(42, 157, 143, 0.1));
            border: 1px dashed rgba(20, 33, 61, 0.15);
            border-radius: 1rem;
            color: #5b6880;
            display: flex;
            justify-content: center;
            min-height: 180px;
            text-align: center;
        }

        .item-thumb {
            border-radius: 1rem;
            height: 220px;
            object-fit: cover;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container py-4 py-lg-5">
        <nav class="navbar navbar-expand-lg navbar-light navbar-shell px-3 px-lg-4 py-3 mb-4">
            <div class="container-fluid px-0">
                <a class="navbar-brand fw-bold text-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                    <span class="brand-mark">LF</span>
                    <span>Lost &amp; Found</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mt-3 mt-lg-0" id="mainNav">
                    <ul class="navbar-nav ms-lg-4 me-auto gap-lg-2">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        @auth
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('lost-items.index') }}">Lost Items</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('found-items.index') }}">Found Items</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Profile</a></li>
                        @endauth
                    </ul>
                    <div class="d-flex flex-column flex-lg-row gap-2">
                        @auth
                            <span class="badge badge-soft align-self-lg-center px-3 py-2">Signed in as {{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-dark">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-accent">Create Account</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        @include('partials.flash')

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
