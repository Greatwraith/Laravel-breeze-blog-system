<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        @include('admin.layouts.sidebar')

        {{-- Main content --}}
        <main class="flex-1 px-8 py-6">
            {{-- Page title --}}
            <div class="mb-6 border-b border-gray-200 pb-4">
                <h1 class="text-2xl font-semibold text-gray-900">
                    @yield('page-title')
                </h1>
            </div>

            {{-- Page content --}}
            @yield('content')
        </main>

    </div>

</body>
</html>
l