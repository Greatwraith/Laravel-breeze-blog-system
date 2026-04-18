@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-8">

    <!-- Page Title -->
    <div>
        <h1 class="text-2xl font-semibold text-gray-900">
            Admin Dashboard
        </h1>
        <p class="mt-1 text-sm text-gray-600">
            Overview of the system
        </p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

        <!-- Total Posts -->
        <div class="rounded-lg border border-gray-200 bg-white p-6">
            <p class="text-sm font-medium text-gray-500">
                Total Posts
            </p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">
                {{ \App\Models\Post::count() }}
            </p>
        </div>

        <!-- Total Users -->
        <div class="rounded-lg border border-gray-200 bg-white p-6">
            <p class="text-sm font-medium text-gray-500">
                Total Users
            </p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">
                {{ \App\Models\User::count() }}
            </p>
        </div>

        <!-- Admins -->
        <div class="rounded-lg border border-gray-200 bg-white p-6">
            <p class="text-sm font-medium text-gray-500">
                Admin Accounts
            </p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">
                {{ \App\Models\User::where('role', 'admin')->count() }}
            </p>
        </div>

    </div>

    <!-- Welcome Card -->
    <div class="rounded-lg border border-gray-200 bg-white p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Welcome back, {{ Auth::user()->name }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 max-w-2xl">
            You are logged in as an administrator. You have full access to manage
            posts and users in the system.
        </p>
    </div>

</div>
@endsection
