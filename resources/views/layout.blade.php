<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Permissions - {{ config('app.name', 'Laravel') }}</title>

    @vite('resources/css/app.css')
</head>
<body class="h-full bg-gray-100 p-5">
    <main class="mx-auto max-w-7xl rounded-lg bg-white p-5 shadow-md space-y-4">
        <div class="space-x-2">
            <a class="text-gray-800 hover:text-gray-600 hover:underline" href="{{ route(config('permissions.route_name_prefix') . 'users.index') }}">Users</a>
            <a class="text-gray-800 hover:text-gray-600 hover:underline" href="{{ route(config('permissions.route_name_prefix') . 'roles.index') }}">Roles</a>
            <a class="text-gray-800 hover:text-gray-600 hover:underline" href="{{ route(config('permissions.route_name_prefix') . 'permissions.index') }}">Permissions</a>
        </div>

        <div class="max-w-full">
            @yield('content')
        </div>
    </main>
</body>
</html>
