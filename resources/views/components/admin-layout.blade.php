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

  <div class="flex h-screen  overflow-hidden bg-[#F6F1F1]">
    <div class="hidden md:flex md:flex-shrink-0">
      <div class="flex  flex-col w-64">
        <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-[#146C94] border-r">
          <div class="flex flex-col flex-shrink-0 px-4">
            <a class="text-lg font-semibold tracking-tighter text-black focus:outline-none focus:ring " href="/">
              <span class="flex flex-col items-center ">
                <img src="{{ asset('images/logo.png') }}" class="h-14" alt="">

                <span class="font-black text-sm text-center text-white underline">Clearance Processing System</span>
              </span> </a>
            <button class="hidden rounded-lg focus:outline-none focus:shadow-outline">
              <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                <path fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                  clip-rule="evenodd"></path>
                <path fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
          </div>
          <div class="flex flex-col  flex-grow mt-5">
            <nav class="flex-1 space-y-1 bg-[#146C94] relative">
              <div class="absolute bottom-0 left-0">
                <img src="{{ asset('images/logo.png') }}" class="opacity-5" alt="">
              </div>

              <ul class="px-2">
                <li>
                  <a class="{{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 text-[#146C94] fill-[#146C94] font-bold' : 'fill-white text-white' }} inline-flex items-center w-full px-4 py-2  mt-1 text-sm transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-[#146C94] hover:fill-[#146C94] hover:font-bold"
                    href="{{ route('admin.dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                      <path
                        d="M13 21V11H21V21H13ZM3 13V3H11V13H3ZM9 11V5H5V11H9ZM3 21V15H11V21H3ZM5 19H9V17H5V19ZM15 19H19V13H15V19ZM13 3H21V9H13V3ZM15 5V7H19V5H15Z">
                      </path>
                    </svg>
                    <span class="ml-2">
                      Dashboard
                    </span>
                  </a>
                </li>
              </ul>
              <p class="px-4 pt-4 text-xs font-semibold text-gray-300 uppercase">
                MANAGE
              </p>
              <ul class="px-2">

                <li>
                  <a class="{{ request()->routeIs('admin.student') ? 'bg-gray-100 text-[#146C94] fill-[#146C94] font-bold' : 'fill-white text-white' }} inline-flex items-center w-full px-4 py-2  mt-1 text-sm transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-[#146C94] hover:fill-[#146C94] hover:font-bold"
                    href="{{ route('admin.student') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                      <path
                        d="M20 22H18V20C18 18.3431 16.6569 17 15 17H9C7.34315 17 6 18.3431 6 20V22H4V20C4 17.2386 6.23858 15 9 15H15C17.7614 15 20 17.2386 20 20V22ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13ZM12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z">
                      </path>
                    </svg>
                    <span class="ml-2">
                      Students
                    </span>
                  </a>
                </li>
                <li>
                  <a class="{{ request()->routeIs('admin.teacher') ? 'bg-gray-100 text-[#146C94] fill-[#146C94] font-bold' : 'fill-white text-white' }} inline-flex items-center w-full px-4 py-2  mt-1 text-sm  transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-[#146C94] hover:fill-[#146C94] hover:font-bold"
                    href="{{ route('admin.teacher') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                      <path
                        d="M20 22H18V20C18 18.3431 16.6569 17 15 17H9C7.34315 17 6 18.3431 6 20V22H4V20C4 17.2386 6.23858 15 9 15H15C17.7614 15 20 17.2386 20 20V22ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13ZM12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z">
                      </path>
                    </svg>
                    <span class="ml-2">
                     Teachers
                    </span>
                  </a>
                </li>
                <li>
                <li>
                  <a class="{{ request()->routeIs('admin.grade-level') ? 'bg-gray-100 text-[#146C94] fill-[#146C94] font-bold' : 'fill-white text-white' }} inline-flex items-center w-full px-4 py-2  mt-1 text-sm transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-[#146C94] hover:fill-[#146C94] hover:font-bold"
                    href="{{ route('admin.grade-level') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                      <path
                        d="M13 21V11H21V21H13ZM3 13V3H11V13H3ZM9 11V5H5V11H9ZM3 21V15H11V21H3ZM5 19H9V17H5V19ZM15 19H19V13H15V19ZM13 3H21V9H13V3ZM15 5V7H19V5H15Z">
                      </path>
                    </svg>
                    <span class="ml-2">
                      Grade Level
                    </span>
                  </a>
                </li>

                <li>
                  <a class="{{ request()->routeIs('admin.subjects') ? 'bg-gray-100 text-[#146C94] fill-[#146C94] font-bold' : 'fill-white text-white' }} inline-flex items-center w-full px-4 py-2  mt-1 text-sm transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-[#146C94] hover:fill-[#146C94] hover:font-bold"
                    href="{{ route('admin.subjects') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                      <path
                        d="M20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22ZM19 20V4H5V20H19ZM7 6H11V10H7V6ZM7 12H17V14H7V12ZM7 16H17V18H7V16ZM13 7H17V9H13V7Z">
                      </path>
                    </svg>
                    <span class="ml-2">
                      Subjects
                    </span>
                  </a>
                </li>

                <li>
                  <a class="{{ request()->routeIs('admin.strand') ? 'bg-gray-100 text-[#146C94] fill-[#146C94] font-bold' : 'fill-white text-white' }} inline-flex items-center w-full px-4 py-2  mt-1 text-sm transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-[#146C94] hover:fill-[#146C94] hover:font-bold"
                    href="{{ route('admin.strand') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                      <path
                        d="M20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22ZM19 20V4H5V20H19ZM7 6H11V10H7V6ZM7 12H17V14H7V12ZM7 16H17V18H7V16ZM13 7H17V9H13V7Z">
                      </path>
                    </svg>
                    <span class="ml-2">
                      Strands
                    </span>
                  </a>
                </li>
              </ul>
              <div class="border-t-2"></div>
              <p class="px-4 pt-4 text-xs font-semibold text-gray-300 uppercase">
                SETTINGS
              </p>
              <ul class="px-2">
                <li>
                  <a class="{{ request()->routeIs('admin.users') ? 'bg-gray-100 text-[#146C94] fill-[#146C94] font-bold' : 'fill-white text-white' }} inline-flex items-center w-full px-4 py-2  mt-1 text-sm transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-[#146C94] hover:fill-[#146C94] hover:font-bold"
                    href="{{ route('admin.users') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                      <path
                        d="M20 22H18V20C18 18.3431 16.6569 17 15 17H9C7.34315 17 6 18.3431 6 20V22H4V20C4 17.2386 6.23858 15 9 15H15C17.7614 15 20 17.2386 20 20V22ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13ZM12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z">
                      </path>
                    </svg>
                    <span class="ml-2">
                      Users
                    </span>
                  </a>
                </li>
                {{-- <li>
                  <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-white transition duration-200 ease-in-out fill-white transform border-l-4 border-transparent focus:shadow-outline hover:border-white hover:scale-95  hover:font-medium hover:text-white "
                    href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                      <path
                        d="M6 12H18V8H14V4H6V12ZM4 12V2.9954C4 2.44565 4.44484 2 4.99558 2H15L19.9997 7L20 12H22V14H2V12H4ZM3 16H5V22H3V16ZM19 16H21V22H19V16ZM15 16H17V22H15V16ZM11 16H13V22H11V16ZM7 16H9V22H7V16Z">
                      </path>
                    </svg>
                    <span class="ml-2">
                      Clearance
                    </span>
                  </a>
                </li> --}}
                <li>
                  <a class="{{ request()->routeIs('admin.clearance') ? 'bg-gray-100 text-[#146C94] fill-[#146C94] font-bold' : 'fill-white text-white' }} inline-flex items-center w-full px-4 py-2  mt-1 text-sm transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-[#146C94] hover:fill-[#146C94] hover:font-bold"
                    href="{{ route('admin.clearance') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                      <path
                        d="M6 12H18V8H14V4H6V12ZM4 12V2.9954C4 2.44565 4.44484 2 4.99558 2H15L19.9997 7L20 12H22V14H2V12H4ZM3 16H5V22H3V16ZM19 16H21V22H19V16ZM15 16H17V22H15V16ZM11 16H13V22H11V16ZM7 16H9V22H7V16Z">
                      </path>
                    </svg>
                    <span class="ml-2">
                      Clearance
                    </span>
                  </a>
                </li>
              </ul>
                <p class="px-4 pt-4 text-xs font-semibold text-gray-300 uppercase">
                REPORTS
              </p>
                <ul class="px-2">
                <li>
                  <a class="{{ request()->routeIs('admin.reports') ? 'bg-gray-100 text-[#146C94] fill-[#146C94] font-bold' : 'fill-white text-white' }} inline-flex items-center w-full px-4 py-2  mt-1 text-sm transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-[#146C94] hover:fill-[#146C94] hover:font-bold"
                    href="{{ route('admin.reports') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"><path d="M21 8V20.9932C21 21.5501 20.5552 22 20.0066 22H3.9934C3.44495 22 3 21.556 3 21.0082V2.9918C3 2.45531 3.4487 2 4.00221 2H14.9968L21 8ZM19 9H14V4H5V20H19V9ZM8 7H11V9H8V7ZM8 11H16V13H8V11ZM8 15H16V17H8V15Z"></path></svg>
                    <span class="ml-2">
                      Reports
                    </span>
                  </a>
                </li>
             
              </ul>
            </nav>
          </div>
          <div class="flex flex-shrink-0 p-4 px-4 bg-[#AFD3E2]">
            <div @click.away="open = false" class="relative inline-flex items-center w-full" x-data="{ open: false }">
              <button @click="open = !open"
                class="inline-flex items-center justify-between w-full px-4 py-3 text-lg font-medium text-center text-white transition duration-500 ease-in-out transform rounded-xl hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <span>
                  <span class="flex-shrink-0 block group">
                    <div class="flex items-center">
                      <div>
                        <img class="flex flex-shrink object-cover rounded-full h-9 w-9"
                          src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=2070&amp;q=80"
                          alt="">
                      </div>
                      <div class="ml-3 text-left">
                        <p class="text-sm font-bold text-gray-600  uppercase  group-hover:text-blue-500">
                          {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs font-medium text-gray-600 group-hover:text-blue-500">
                          {{ auth()->user()->role->name }}
                        </p>
                      </div>
                    </div>
                  </span>
                </span>
                <svg :class="{ 'rotate-180': open, 'rotate-0': !open }" xmlns="http://www.w3.org/2000/svg"
                  class="inline w-5 h-5 ml-4 fill-gray-600 text-black transition-transform duration-200 transform rotate-0"
                  viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                    clip-rule="evenodd"></path>
                </svg>
              </button>
              <div x-show="open" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute bottom-0 z-50 w-full mx-auto mt-2 origin-bottom-right bg-white rounded-xl"
                style="display: none;">
                <div class="px-2 py-2 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                  <ul>
                    <li>
                      <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform border-l-4 border-transparent focus:shadow-outline hover:border-blue-500 hover:scale-95 hover:text-blue-500"
                        href="#">
                        <ion-icon class="w-4 h-4 md hydrated" name="body-outline" role="img"
                          aria-label="body outline"></ion-icon>
                        <span class="ml-4">
                          Account
                        </span>
                      </a>
                    </li>
                   <li>
                      <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 fill-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-red-100 hover:scale-95 hover:text-red-500 hover:fill-red-500"
                          href="#"
                          onclick="event.preventDefault();
              this.closest('form').submit();">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4">
                            <path
                              d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C15.2713 2 18.1757 3.57078 20.0002 5.99923L17.2909 5.99931C15.8807 4.75499 14.0285 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C14.029 20 15.8816 19.2446 17.2919 17.9998L20.0009 17.9998C18.1765 20.4288 15.2717 22 12 22ZM19 16V13H11V11H19V8L24 12L19 16Z">
                            </path>
                          </svg>
                          <span class="ml-4">
                            Logout
                          </span>
                        </a>
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col flex-1 w-0 overflow-hidden">
      <main class="relative flex-1 overflow-y-auto focus:outline-none">
        <div class="py-6">
          <div class="px-4 mx-auto 2xl:max-w-7xl sm:px-6 md:px-8">

            <section>
              <div class="items-center ">
                <div class="justify-center w-full mx-auto">
                  <nav class="flex py-3 border-y" aria-label="Breadcrumb">
                    <ol role="list" class="flex items-center space-x-4">
                      <li>
                        <div class="flex items-center">
                          <a href="#"
                            class="inline-flex items-center text-sm font-medium  fill-gray-500 text-gray-500 duration-200 hover:text-gray-700 hover:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                              <path
                                d="M12.6727 1.61162 20.7999 9H17.8267L12 3.70302 6 9.15757V19.0001H11V21.0001H5C4.44772 21.0001 4 20.5524 4 20.0001V11.0001L1 11.0001 11.3273 1.61162C11.7087 1.26488 12.2913 1.26488 12.6727 1.61162ZM14 11H23V18H14V11ZM16 13V16H21V13H16ZM24 21H13V19H24V21Z">
                              </path>
                            </svg>
                            <span class="ml-4 font-bold">
                              Home
                            </span>
                          </a>
                        </div>
                      </li>
                      <li>
                        <div class="flex items-center">
                          <span class="flex-shrink-0 w-5 h-5 font-bold text-gray-300">
                            /
                          </span>
                          <a href="#"
                            class="ml-4 text-sm font-medium text-gray-500 hover:scale-95 hover:text-gray-700">
                            @yield('title')
                          </a>
                        </div>
                      </li>

                    </ol>
                  </nav>
                </div>
              </div>
            </section>
            <div class="mt-5 bg-white rounded-lg p-5">
              {{ $slot }}
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  @livewireScripts
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <x-livewire-alert::scripts />

</body>

</html>
