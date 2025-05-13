<!DOCTYPE html>
<html lang="ar" dir="rtl" style="overflow-x: hidden;">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-E5E2FZ4TMQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-E5E2FZ4TMQ');
    </script>

    @if (request()->path() === 'request-evaluation')
        <!-- Custom GTAG -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11048763710"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());

            gtag('config', 'AW-11048763710');
        </script>
    @endif


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/favicon.png">
    <meta name="google-site-verification" content="uW8BDRhLNOw4-pBQI4lZFH5fiS1Cd_AWv-EyYEHmrkg" />

    <title>{{ $page['props']['title'] }}</title>
    <meta name="title" content="{{ $page['props']['title'] }}">
    <meta name="description" content="{{ $page['props']['description'] }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @viteReactRefresh
    @vite(['resources/js/app.tsx', "resources/js/Pages/{$page['component']}.tsx"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>