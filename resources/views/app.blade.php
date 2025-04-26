<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head class="h-full bg-[#0C111D]">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @routes
        @vite([
            'resources/js/app.js',
            str_contains($page['component'], '::') 
                ? "Modules/" . str_replace('::', '/resources/assets/js/Pages/', $page['component']) . '.vue'
                : "resources/js/Pages/{$page['component']}.vue"
        ])
        @inertiaHead
    </head>
    <body class="font-sans antialiased h-full bg-[#0C111D]">
        @inertia
    </body>
</html>