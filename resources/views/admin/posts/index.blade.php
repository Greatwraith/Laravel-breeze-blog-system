@extends('admin.layouts.app')

@section('title', 'Manage Posts')

@section('content')
<div class="space-y-6">

    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                Manage Posts
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                All posts in the system
            </p>
        </div>
    </div>

    <!-- Search & Filter -->
    <form method="GET"
          action="{{ route('admin.posts.index') }}"
          class="flex flex-wrap items-end gap-4">

        <!-- Keyword -->
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Search
            </label>
            <input
                type="text"
                name="keyword"
                value="{{ request('keyword') }}"
                placeholder="Title or author..."
                class="mt-1 w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
        </div>

        <!-- Category -->
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Category
            </label>
            <select
                name="category"
                class="mt-1 w-48 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Buttons -->
        <div class="flex gap-2">
            <button
                type="submit"
                class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                Filter
            </button>

            <a href="{{ route('admin.posts.index') }}"
               class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Reset
            </a>
        </div>
    </form>

    @if (request()->hasAny(['keyword', 'category']))
    <p class="text-sm text-gray-500">
        Showing filtered results
    </p>
@endif



    <!-- Table -->
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Title</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Author</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Category</th>
                    <th class="px-6 py-3 text-right font-medium text-gray-600">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse ($posts as $post)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-900">
                            {{ $post->title }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $post->author->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $post->category->name }}
                        </td>

                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('admin.posts.edit', $post->slug) }}"
                               class="text-sm text-blue-600 hover:underline">
                                Edit
                            </a>

                            <form action="{{ route('admin.posts.destroy', $post->slug) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Delete this post?')"
                                    class="text-sm text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="px-6 py-6 text-center text-gray-500">
                            No posts found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div>
        {{ $posts->links() }}
    </div>

</div>
@endsection
