<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
    <title>@yield('title')</title>
</head>
<body class="h-full">

    <x-navbar />
    @include('components.header')


 <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-6">
    {{ $slot }}
</main>


<script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>
</html>
