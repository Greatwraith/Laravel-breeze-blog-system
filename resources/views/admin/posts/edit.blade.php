@extends('admin.layouts.app')

@section('title', 'Edit Post (Admin)')

@section('content')
<div class="max-w-7xl relative p-4 bg-white rounded-lg border dark:bg-gray-800 sm:p-5">

    <!-- Header -->
    <div class="flex justify-between items-center pb-4 mb-4 border-b sm:mb-5 dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Edit Post (Admin)
        </h3>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.posts.update', $post->slug) }}" method="POST">
        @csrf
        @method('PATCH')

        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title', $post->title) }}"
                class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm
                       focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                       @error('title') border-red-500 bg-red-50 text-red-900 @enderror"
                autofocus
            >
            @error('title')
                <p class="mt-2.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <select
                name="category_id"
                id="category"
                class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm
                       focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                       @error('category_id') border-red-500 bg-red-50 @enderror"
            >
                <option value="">Select post category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((old('category_id', $post->category_id) == $category->id))>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-2.5 text-sm text-red-600">Please select a category.</p>
            @enderror
        </div>

       <!-- Body (Read-Only for Admin) -->
<div class="mb-6">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body</label>
    <div class="p-4 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200 min-h-[200px]">
        {!! $post->body !!}
    </div>
</div>

<!-- Author Email Info -->
<div class="mb-6">
    @if($post->author && $post->author->email)
        <p class="text-m text-gray-700 dark:text-gray-200">
            Author Email: 
            <span class="font-medium text-blue-700 dark:text-blue-300">
                {{ $post->author->email }}
            </span>
        </p>
        <p class="text-xl text-gray-500 dark:text-gray-400 font-body">
            Please contact this person/email to change the Body.
        </p>
    @else
        <p class="text-sm text-red-600">No author email available for this post.</p>
    @endif
</div>


        <!-- Actions -->
        <div class="flex gap-2">
            <button
                type="submit"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
            >
                Update Post
            </button>

            <a
                href="{{ route('admin.posts.index') }}"
                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
