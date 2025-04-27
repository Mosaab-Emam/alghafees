<!DOCTYPE html>
<html lang="ar" dir="rtl" style="overflow-x: hidden;">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FB7TPQBY5P"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-FB7TPQBY5P');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=2">
    <link rel="icon" type="image/x-icon" href="/logo.png">
    <meta name="google-site-verification" content="uW8BDRhLNOw4-pBQI4lZFH5fiS1Cd_AWv-EyYEHmrkg" />

    <title inertia>شركة صالح بن علي الغفيص للتقييم العقاري</title>

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