<x-layout-user :title="$title">

<section>
    <div class="py-8 px-4 mx-auto max-w-7xl lg:py-16 lg:px-6">

        {{-- SEARCH FORM --}}
        <form action="{{ route('posts') }}" method="GET"
              class="max-w-2xl mx-auto mb-8 flex items-center space-x-3">

            {{-- KEEP CATEGORY WHEN SEARCH --}}
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
             @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
            @endif

            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-3.5-3.5M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                <input type="search"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search posts..."
                       class="block w-full p-3 pl-10 pr-24 rounded-lg border border-gray-300
                              bg-white text-sm focus:ring-blue-500 focus:border-blue-500"/>

                <button type="submit"
                        class="absolute right-1.5 top-1.5 px-4 py-2 text-xs font-medium
                               text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Search
                </button>
            </div>
        </form>

         {{ $posts->links() }}
         

        {{-- POSTS GRID --}}
        <div class="mt-4 grid gap-8 md:grid-cols-2 lg:grid-cols-3">

            @forelse ($posts as $post)

                <article class="p-6 bg-white rounded-lg border border-gray-200 shadow
                                dark:bg-gray-800 dark:border-gray-700">

                    {{-- CATEGORY + DATE --}}
                    <div class="flex justify-between items-center mb-5 text-gray-500">

                        <span class="{{ $post->category->color }}
                                     text-xs font-medium inline-flex items-center px-3 py-1 rounded-full">

                            {{-- 🔥 FIX: MERGE QUERY --}}
                            <a href="{{ route('posts', array_merge(request()->query(), [
                                'category' => $post->category->slug
                            ])) }}"
                               class="hover:underline">

                                {{ $post->category->name }}
                            </a>
                        </span>

                        <span class="text-sm">
                            {{ $post->created_at->diffForHumans() }}
                        </span>
                    </div>

                    {{-- TITLE --}}
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <a href="{{ route('post.detail', $post->slug) }}" class="hover:underline">
                            {{ $post->title }}
                        </a>
                    </h2>

                    {{-- EXCERPT --}}
                    <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
                        {!! Str::limit($post->body, 100) !!}
                    </p>

                    {{-- AUTHOR + READ MORE --}}
                    <div class="flex justify-between items-center">

                        <a href="/posts?author={{ $post->author->username }}">
                        <div class="flex items-center space-x-3">
                            <img
    src="{{ $post->author->avatar 
        ? asset('storage/' . $post->author->avatar) 
        : asset('image/defaultavatar.png') }}"
    alt="{{ $post->author->name }}"
    class="w-9 h-9 rounded-full object-cover"
/>

                            <span class="text-xs font-medium dark:text-white">
                                {{ $post->author->name }}
                            </span>
                        </div>
                        </a>

                        <a href="{{ route('post.detail', $post->slug) }}"
                           class="inline-flex items-center text-xs font-medium
                                  text-blue-500 hover:underline">
                            Read more →
                        </a>

                    </div>
                </article>

            @empty
                <p class="mt-4 text-center text-xl col-span-full text-gray-500">
                    No posts found.
                </p>
                <a href="/posts" class="text-center col-span-full text-blue-500 hover:underline">&laquo; Back to Posts</a>
                
            @endforelse

        </div>
    </div>
</section>

</x-layout-user>
