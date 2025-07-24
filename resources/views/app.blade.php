<!DOCTYPE html>
<html lang="ar" dir="rtl" style="overflow-x: hidden;">

<head>
    <!-- Should be as hight in <head> as possible -->
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MRPWJN6X');</script>
    <!-- End Google Tag Manager -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-E5E2FZ4TMQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-E5E2FZ4TMQ');
    </script>

    @if (request()->path() === '/' || request()->path() === 'request-evaluation')
        <!-- Custom GTAG -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11048763710"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());

            gtag('config', 'AW-11048763710');
        </script>
    @endif

    <script type="text/javascript">
        (function (c, l, a, r, i, t, y) {
            c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments) };
            t = l.createElement(r); t.async = 1; t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0]; y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "s9s47n96kc");
    </script>


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

    <script>
        var tamaraWidgetConfig = {
            lang: "ar",
            country: "SA",
            publicKey: "26846036-40f9-4f3f-853a-e5381f016b4f",
            css: "",
            style: { // Optional to define CSS variable
                fontSize: '16px',
                badgeRatio: 1, // The radio of logo, we can make it big or small by changing the radio.
            }
        }
    </script>
    <script defer src="https://cdn.tamara.co/widget-v2/tamara-widget.js"></script>

    <!-- Scripts -->
    @routes
    @viteReactRefresh
    @vite(['resources/js/app.tsx', "resources/js/Pages/{$page['component']}.tsx"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MRPWJN6X" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @inertia

</body>

</html>