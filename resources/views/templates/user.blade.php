<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title-page', 'KateringKu')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .fluid-heading {
            font-size: clamp(1.5rem, 5vw, 3rem); /* scales between 1.5rem and 3rem */
        }
    </style>

</head>
<body>

    {{-- Blurred background header --}}
    <header class="position-relative text-white text-center" style="height: 300px; overflow: hidden;">
        {{-- Background Blur --}}
        <div class="position-absolute top-0 start-0 w-100 h-100"
             style="background-image: url('{{ asset('background.jpeg') }}');
                    background-size: cover;
                    background-position: center;
                    filter: blur(3px);
                    transform: scale(1.1);
                    z-index: 1;">
        </div>

        {{-- Transparent navbar on top --}}
        <div class="position-absolute top-0 start-0 w-100 z-3">
            @include('partials.navbar')
        </div>

        {{-- Centered header content --}}
        <div class="position-relative z-2 d-flex justify-content-center align-items-center h-100 px-3">
            @yield('header')
        </div>
    </header>

    {{-- Main content --}}
    @yield('content')

    {{-- Footer --}}
    <footer class="bg-light text-center text-lg-start mt-4">
        <div class="text-center p-3">
            © 2025 KateringKu. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>