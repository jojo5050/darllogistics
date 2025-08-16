<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: url('your-hero-image.jpg') center/cover no-repeat;
            min-height: 90vh;
            display: flex;
            align-items: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .services .card {
            border: none;
            transition: transform 0.3s;
        }

        .services .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .cta {
            background: #0d6efd;
            color: white;
            padding: 3rem 0;
            text-align: center;
        }

        footer {
            background: #111;
            color: #ccc;
            padding: 2rem 0;
        }

        footer a {
            color: #ccc;
            text-decoration: none;
        }
    </style>
</head>

<body>

    @include('partials.landing-menu')

    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>&copy; 2025 Darl Transport & Dispatch. All Rights Reserved.</p>
            <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
