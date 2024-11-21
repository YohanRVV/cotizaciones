<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel + Inertia</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="{{ asset('vendor/ziggy/js/route.js') }}" defer></script>
</head>

<body>
    @inertia
</body>

</html>
