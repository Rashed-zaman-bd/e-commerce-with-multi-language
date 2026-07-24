<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Laravel App')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Top Banner -->
    <x-topbanner/>

    <!-- Navbar -->
    <x-nav/>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto">
        @yield('content')
    </main>

    <!------ footer--------------->
    <x-footer/>

</body>
</html>