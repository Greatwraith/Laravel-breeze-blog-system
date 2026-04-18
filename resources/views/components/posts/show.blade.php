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
        Back to Show
      </a>

      <header class="mb-6 not-format">
        <address class="flex items-center mb-6 not-italic">
          <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">

          <img
    class="mr-4 w-16 h-16 rounded-full object-cover border border-gray-200 dark:border-gray-700"
    src="{{ $post->author->avatar
        ? Storage::url($post->author->avatar)
        : asset('image/defaultavatar.png') }}"
    alt="{{ $post->author->name }} avatar"
    loading="lazy"
/>


            <div>
              {{-- AUTHOR --}}
              <a href="{{ route('posts', [
                  'author' => $post->author->username
              ]) }}"
                 rel="author"
                 class="text-xl font-bold text-gray-900 dark:text-white hover:underline">
                {{ $post->author->name }}
              </a>
              <span class="{{ $post->category->color }}">{{ $post->category->name }}</span>

            
              

              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                {{ $post->created_at->format('d M Y') }}
                · {{ $post->created_at->diffForHumans() }}
              </p>
            </div>

          </div>
        </address>

      <div class="flex items-center gap-4">
    {{-- EDIT --}}
    <a href="/dashboard/{{ $post->slug }}/edit"
       class="inline-flex items-center text-white bg-blue-600 hover:bg-blue-700
              focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm
              px-5 py-2.5 dark:bg-blue-500 dark:hover:bg-blue-600">
        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
            <path fill-rule="evenodd"
                  d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                  clip-rule="evenodd"/>
        </svg>
        Edit
    </a>
   

        </div>


   

        
  

        <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:text-4xl dark:text-white">
          {{ $post->title }}
        </h1>
      </header>

      <div class="lead">
        {!! $post->body !!}
      </div>

    </article>
  </div>
</main>