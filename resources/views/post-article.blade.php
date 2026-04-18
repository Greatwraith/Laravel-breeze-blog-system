<x-layout-user :title="$title">

<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
  <div class="flex justify-between px-4 mx-auto max-w-7xl">
    <article class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">

      {{-- BACK --}}
      <a href="{{ route('posts', request()->query()) }}"
         class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline mb-6">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
                d="M7.707 14.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L4.414 9H18a1 1 0 110 2H4.414l3.293 3.293a1 1 0 010 1.414z"
                clip-rule="evenodd"/>
        </svg>
        Back to all posts
      </a>

      <header class="mb-6 not-format">
        <address class="flex items-center mb-6 not-italic">
          <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">

            <img class="mr-4 w-16 h-16 rounded-full"
                 src="{{ $singlepost->author->avatar ? asset('storage/' . $singlepost->author->avatar) : asset('image/defaultavatar.png') }}"
                 alt="{{ $singlepost->author->name }}"/>

            <div>
              {{-- AUTHOR --}}
              <a href="{{ route('posts', [
                  'author' => $singlepost->author->username
              ]) }}"
                 rel="author"
                 class="text-xl font-bold text-gray-900 dark:text-white hover:underline">
                {{ $singlepost->author->name }}
              </a>

              {{-- CATEGORY --}}
              <a href="{{ route('posts', ['category' => $singlepost->category->slug]) }}"
   class="{{ $singlepost->category->color }}">
   {{ $singlepost->category->name }}
</a>

        <address>

              {{-- DATE --}}
              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                {{ $singlepost->created_at->format('d M Y') }}
                · {{ $singlepost->created_at->diffForHumans() }}
              </p>
            </div>

          </div>
        </address>

        <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:text-4xl dark:text-white">
          {{ $singlepost->title }}
        </h1>
      </header>

      <div class="lead">
        {!! $singlepost->body !!}
      </div>

    </article>
  </div>
</main>

</x-layout-user>
