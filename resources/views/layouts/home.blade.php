<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-gray-700">
<main class="mx-auto flex flex-col justify-center items-center">
    @if(session('success'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transitions
            class="bg-green-100 text-green-800 p-3 rounded mb-4"
        >
            {{ session('success') }}
        </div>
    @endif
    @yield('content')
</main>
</body>

</html>
