<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" href="https://i.ibb.co/4T9xYSL/me.jpg" type="image/png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @spladeHead
    @vite('resources/js/app.js')
</head>

<body class="font-sans antialiased bg-white">
    @splade
</body>

</html>
