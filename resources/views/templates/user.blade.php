<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title-page', 'KateringKu')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- // Header --}}
    <style>
        .header-blur::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url('{{ asset('background.jpeg') }}');
            background-size: cover;
            background-position: center;
            filter: blur(3px);
            transform: scale(1.1); /* Hide blur edges */
            z-index: 1;
        }

        .header-blur {
            position: relative;
            color: white;
            z-index: 2;
            background-color: rgba(0, 0, 0, 0.4); /* optional overlay */
        }

        .header-blur > * {
            position: relative;
            z-index: 3;
        }
    </style>
</head>
<body> 
    <header class="header-blur d-flex align-items-center justify-content-center text-center" style="height: 300px;">
        <div>
            @yield('header')
        </div>
    </header>



    @yield('content')

    <footer class="bg-light text-center text-lg-start mt-4">
        <div class="text-center p-3">
            © 2025 KateringKu. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>