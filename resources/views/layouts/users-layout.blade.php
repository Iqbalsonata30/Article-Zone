<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="/css/style.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-200 min-h-screen">
    {{ $slot }}
    <script src="/js/script.js"></script>
</body>

</html>
