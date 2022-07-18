@props(['tags' => []])

<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- 3rd-party library -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    </head>
    <body class="font-sans antialiased h-full">
        <x-jet-banner />

        <div x-data="{ showMenu: false }" class="min-h-full">
          <!-- Static sidebar for desktop -->
          <div
            class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0 lg:border-r lg:border-gray-200 lg:pt-5 lg:pb-4 lg:bg-gray-100">
            <a href="/" class="flex items-center flex-shrink-0 px-6">
              <img class="h-8 w-auto" src="/logo.svg" alt="الأرشيف الإلكتروني">
            </a>
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="mt-6 h-0 flex-1 flex flex-col overflow-y-auto">
              <!-- User account dropdown -->
              <div class="px-3 relative inline-block text-right">
                <div class="">
                  <!-- Secondary navigation -->
                  <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider" id="desktop-create-options">
                    إضافة مستند من</h3>
                  <div class="mt-1 space-x-1" role="group" aria-labelledby="desktop-create-options">
                    <form action="{{ route('media') }}" enctype="multipart/form-data" method="POST" class="inline-flex">
                      @csrf()
                      <label class="inline-flex items-center px-3 py-2 border cursor-pointer border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <input type="file" name="media" onchange="event.target.form.submit()" class="sr-only" />
                        جهاز الكومبيوتر
                      </label>
                    </form>
                    <x-button>الماسح الضوئي</x-button>
                  </div>
                </div>
              </div>
              <!-- Navigation -->
              <nav class="px-3 mt-6">
                <div class="space-y-1">
                  <!-- Current: "bg-gray-200 text-gray-900", Default: "text-gray-700 hover:text-gray-900 hover:bg-gray-50" -->
                  <a href="#"
                    class="bg-gray-200 text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md"
                    aria-current="page">
                    <!--
                    Heroicon name: outline/home
      
                    Current: "text-gray-500", Default: "text-gray-400 group-hover:text-gray-500"
                  -->
                    <svg class="text-gray-500 ml-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    الرئيسية
                  </a>
                  
                  <a href="#"
                    class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <!-- Heroicon name: outline/view-list -->
                    <svg class="text-gray-400 group-hover:text-gray-500 ml-3 flex-shrink-0 h-6 w-6"
                      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                      stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    ملفاتي
                  </a>
                  
                  <a href="#"
                    class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <svg class="text-gray-400 group-hover:text-gray-500 ml-3 flex-shrink-0 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    تقارير
                  </a>
      
                </div>
                <div class="mt-8">
                  <!-- Secondary navigation -->
                  <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider" id="desktop-management-headline">
                    الإدارة</h3>
                  <div class="mt-1 space-y-1" role="group" aria-labelledby="desktop-management-headline">
                    <a href="#"
                      class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                      <svg class="text-gray-400 group-hover:text-gray-500 ml-3 flex-shrink-0 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                      الصلاحيات والمستخدمين
                    </a>
                    <a href="#"
                      class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                      <svg class="text-gray-400 group-hover:text-gray-500 ml-3 flex-shrink-0 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"></path><path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"></path><path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"></path></svg>
                      نسخ إحتياطي
                    </a>
                  </div>
                </div>
      
                <div class="mt-8">
                  <!-- Secondary navigation -->
                  <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider" id="desktop-tags-headline">
                    التصنيفات</h3>
                  <div class="mt-1 space-y-1" role="group" aria-labelledby="desktop-tags-headline">
                    @foreach ($tags as $tag)    
                    <x-category-item href="#" :color="$tag->color">
                      {{ $tag->name }}
                    </x-category-item>
                    @endforeach
                  </div>
                </div>
              </nav>
            </div>
          </div>
          <!-- Main column -->
          <div class="lg:pr-64 flex flex-col">
            <main class="flex-1">
              <!-- Page title & actions -->
              <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
                <div class="flex-1 min-w-0">
                  <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">{{ $pageTitle }}</h1>
                </div>
                <x-dropdown>
                  <x-slot:button>
                    @if('admin' === 'admin')
                    <div class="max-w-xs bg-gray-700 p-1.5 text-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                      <span class="sr-only">فتح قائمة المستخدم</span>
                      <svg class="w-5 h-5 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    @else
                    <div class="max-w-xs bg-white text-gray-700 flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                      <span class="sr-only">فتح قائمة المستخدم</span>
                      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
                    </div>
                    @endif
                  </x-slot:button>
                  <div class="divide-y divide-gray-100">
                    <div class="px-4 py-3" role="none">
                      <p class="text-sm" role="none">تم تسجيل الدخول كـ</p>
                      @if('admin' === 'admin')
                      <p class="text-sm font-medium text-gray-900 truncate" role="none">{{ 'حساب الإدارة' }}</p>
                      @else
                      <p class="text-sm font-medium text-gray-900 truncate" role="none">{{ 'علي سماري' }}</p>
                      @endif
                    </div>
                    <div class="py-1" role="none">
                      <form method="POST" action="{{ route('logout') }}" role="none">
                        @csrf()
                        <button type="submit" class="text-gray-700 block w-full text-right px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-3">تسجيل خروج</button>
                      </form>
                    </div>
                  </div>
                </x-dropdown>
              </div>
              
              {{ $slot }}
            </main>
          </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
