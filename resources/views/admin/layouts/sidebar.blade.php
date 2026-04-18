<aside class="w-64 bg-white border-r border-gray-200 px-6 py-8">
    <div class="mb-10">
        <h2 class="text-lg font-bold text-gray-900">
            Admin Panel
        </h2>
        <p class="text-sm text-gray-500">
            Logged in as {{ auth()->user()->username }}
        </p>
    </div>

    <nav class="space-y-2">
        <a href="{{ route('admin.dashboard') }}"
           class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100">
            Dashboard
        </a>

        <a href="{{ route('admin.posts.index') }}"
           class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100">
            Posts
        </a>

        <a href="#"
           class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100">
            Users
        </a>

        <form method="POST" action="{{ route('logout') }}" class="pt-4">
            @csrf
            <button
                type="submit"
                class="w-full text-left px-3 py-2 rounded-md text-sm font-medium text-red-600 hover:bg-red-50">
                Logout
            </button>
        </form>
    </nav>
</aside>
