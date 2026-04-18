<nav class="bg-gray-800" x-data="{ mobileOpen: false }">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">

      <!-- LEFT -->
      <div class="flex items-center">
        <div class="shrink-0">
          <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
               alt="Your Company"
               class="size-8" />
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-4">
            <x-navlink href="{{ route('home') }}" :current="request()->routeIs('home')">Home</x-navlink>
            <x-navlink href="{{ route('posts') }}" :current="request()->routeIs('posts')">Blog</x-navlink>
            <x-navlink href="{{ route('about') }}" :current="request()->routeIs('about')">About</x-navlink>
            <x-navlink href="{{ route('contact') }}" :current="request()->routeIs('contact')">Contact</x-navlink>
          </div>
        </div>
      </div>

      <!-- RIGHT -->
      <div class="hidden md:block">
        <div class="ml-4 flex items-center md:ml-6">
          @auth
            <!-- Profile Dropdown -->
            <div class="relative ml-3" x-data="{ open: false }">
              <button @click="open = !open"
                      :class="open
                        ? 'ring-2 ring-white/80 ring-offset-2 ring-offset-gray-800'
                        : 'hover:ring-2 hover:ring-white/80 hover:ring-offset-2 hover:ring-offset-gray-800'"
                      class="relative flex max-w-xs items-center rounded-full
                             focus-visible:outline-2 focus-visible:outline-offset-2
                             focus-visible:outline-indigo-500 transition cursor-pointer">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open user menu</span>
                <div class="mt-1 text-white text-sm font-medium mr-2">{{ Auth::user()->name }}</div>
                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar ) : asset('image/defaultavatar.png') }}" alt="{{ Auth::user()->name }}" class="size-8 rounded-full outline -outline-offset-1 outline-white/10" />
              </button>
              {{-- {{ $user->avatar ? asset('storage/' . $user->avatar) : asset('image/defaultavatar.png') }} --}}
             
    


              <div x-show="open" x-transition @click.outside="open = false" x-cloak
                   class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg outline-1 outline-black/5">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your profile</a>
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer" >Log out</button>
                </form>
              </div>
            </div>
          @else
            <a href="{{ route('login') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
            <a href="{{ route('register') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
          @endauth
        </div>
      </div>

      <!-- MOBILE BUTTON -->
      <div class="md:hidden">
        <button @click="mobileOpen = !mobileOpen"
                class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>

          <!-- Hamburger Icon -->
          <svg x-show="!mobileOpen" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
               class="size-6">
            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>

          <!-- Close Icon -->
          <svg x-show="mobileOpen" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
               class="size-6">
            <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
    </div>
  </div>

 <!-- MOBILE MENU -->
<div x-show="mobileOpen" x-transition x-cloak class="md:hidden">
  <!-- Menu Links Vertical -->
  <div class="flex flex-col space-y-2 px-2 pt-2 pb-3 sm:px-3">
    <x-navlink href="{{ route('home') }}" :current="request()->routeIs('home')">Home</x-navlink>
    <x-navlink href="{{ route('posts') }}" :current="request()->routeIs('posts')">Blog</x-navlink>
    <x-navlink href="{{ route('about') }}" :current="request()->routeIs('about')">About</x-navlink>
    <x-navlink href="{{ route('contact') }}" :current="request()->routeIs('contact')">Contact</x-navlink>
  </div>

  @auth
    <div class="border-t border-white/10 pt-4 pb-3">
      <div class="flex items-center px-5">
        <div class="shrink-0">
          <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar ) : asset('image/defaultavatar.png') }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full outline-1 outline-white/20" />
        </div>
        <div class="ml-3">
          <div class="text-base font-medium text-white">{{ auth()->user()->name }}</div>
          <div class="text-sm font-medium text-gray-400">{{ auth()->user()->email }}</div>
        </div>
      </div>
      <div class="mt-3 flex flex-col space-y-1 px-2">
        <a href="{{ route('profile.edit') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Your profile</a>
        <a href="{{ route('dashboard') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Settings</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="block w-full text-left rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Log out</button>
        </form>
      </div>
    </div>
  @else
    <div class="border-t border-white/10 pt-4 pb-3">
      <div class="flex flex-col space-y-1 px-2">
        <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Login</a>
        <span class="block px-3 py-2 text-base font-medium text-gray-400">or</span>
        <a href="{{ route('register') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Register</a>
      </div>
    </div>
  @endauth
</div>

</nav>