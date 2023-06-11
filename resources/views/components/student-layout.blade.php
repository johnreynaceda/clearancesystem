<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body class="font-sans antialiased">

  <div class="w-full mx-auto bg-white border-b 2xl:max-w-7xl">
    <div x-data="{ open: false }"
      class="relative flex flex-col w-full p-5 mx-auto bg-white md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
      <div class="flex flex-row items-center justify-between lg:justify-start">
        <a class="text-lg tracking-tight text-black uppercase flex space-x-2 items-center focus:outline-none focus:ring lg:text-2xl"
          href="{{route('adviser.dashboard')}}">
          <img src="{{ asset('images/logo.png') }}" class="h-12" alt="">
          <span class="lg:text-lg uppecase font-bold text-gray-700 focus:ring-0">
            CLEARANCE PROCESSING SYSTEM
          </span>
        </a>
        <button @click="open = !open"
          class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-black focus:outline-none focus:text-black md:hidden">
          <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      <nav :class="{ 'flex': open, 'hidden': !open }"
        class="flex-col items-center flex-grow hidden md:pb-0 md:flex md:justify-end md:flex-row">
       
        <div class="inline-flex items-center gap-2 list-none lg:ml-auto">
          <div class="relative flex space-x-2 items-center flex-shrink-0 ml-5" @click.away="open = false" x-data="{ open: false }">
            <div class="flex flex-col items-start">
              <span class="border-b text-sm font-bold text-gray-600">{{auth()->user()->name}}</span>
              <span class="leading-3 text-sm">{{auth()->user()->role->name}}</span>
            </div>
            <div>
              <button @click="open = !open" type="button"
                class="flex bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">
                  Open user menu
                </span>
                <img class="object-cover w-8 h-8 rounded-full"
                  src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=2070&amp;q=80"
                  alt="">
              </button>
            </div>

            <div x-show="open" x-transition:enter="transition ease-out duration-100"
              x-transition:enter-start="transform opacity-0 scale-95"
              x-transition:enter-end="transform opacity-100 scale-100"
              x-transition:leave="transition ease-in duration-75"
              x-transition:leave-start="transform opacity-100 scale-100"
              x-transition:leave-end="transform opacity-0 scale-95" style="display: none"
              class="absolute right-5 z-10 w-48 py-1 -bottom-32 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
              role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
              <a href="/profile" class="block px-4 py-2 text-sm text-gray-500" role="menuitem" tabindex="-1"
                id="user-menu-item-0">
                Your Profile
              </a>

              <a href="#" class="block px-4 py-2 text-sm text-gray-500" role="menuitem" tabindex="-1"
                id="user-menu-item-1">
                Settings
              </a>

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="#" onclick="event.preventDefault();
              this.closest('form').submit();"
                  class="block px-4 py-2 text-sm text-gray-500" role="menuitem" tabindex="-1" id="user-menu-item-2">
                  Sign out
                </a>
              </form>
            </div>
          </div>

        </div>
      </nav>
    </div>
  </div>
  <div class="">

    <section>
      <div class="items-center  mx-auto max-w-7xl ">
        <div class="justify-center w-full mx-auto">
          <nav class="flex py-3 border-y" aria-label="Breadcrumb">
            <ol role="list" class="flex items-center space-x-4">
              <li>
                <div class="flex items-center">
                  <a href="{{route('adviser.dashboard')}}"
                    class="inline-flex items-center text-sm font-medium text-gray-500 duration-200 hover:text-gray-700 hover:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-500" viewBox="0 0 24 24">
                      <path
                        d="M12.6727 1.61162 20.7999 9H17.8267L12 3.70302 6 9.15757V19.0001H11V21.0001H5C4.44772 21.0001 4 20.5524 4 20.0001V11.0001L1 11.0001 11.3273 1.61162C11.7087 1.26488 12.2913 1.26488 12.6727 1.61162ZM14 11H23V18H14V11ZM16 13V16H21V13H16ZM24 21H13V19H24V21Z">
                      </path>
                    </svg>
                    <span class="ml-4">
                      HOME
                    </span>
                  </a>
                </div>
              </li>
              <li>
                <div class="flex items-center">
                  <span class="flex-shrink-0 w-5 h-5 text-gray-300">
                    /
                  </span>
                  <a href="#"
                    class="ml-4 text-sm font-medium text-gray-500 uppercase hover:scale-95 hover:text-gray-700">
                    @yield('title')
                  </a>
                </div>
              </li>

            </ol>
          </nav>
        </div>
      </div>
    </section>

    <div class="mt-5 mx-auto max-w-7xl">
      {{ $slot }}
    </div>
  </div>
  @livewireScripts
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <x-livewire-alert::scripts />

</body>

</html>
