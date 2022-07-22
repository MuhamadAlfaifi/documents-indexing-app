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
</head>

<body class="font-sans antialiased h-full">
  <div class="min-h-full">
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
                <label
                  class="inline-flex items-center px-3 py-2 border cursor-pointer border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
            <x-nav.nav-item :href="route('posts.index')" :isActive="request()->routeIs('posts.index')" aria-current="page">
              <x-slot name="icon">
                <x-heroicons.home class="ml-3 flex-shrink-0 h-6 w-6" />
              </x-slot>
              الرئيسية
            </x-nav.nav-item>

            <x-nav.nav-item href="#" :isActive="false" aria-current="page">
              <x-slot name="icon">
                <x-heroicons.view-list class="ml-3 flex-shrink-0 h-6 w-6" />
              </x-slot>
              ملفاتي
            </x-nav.nav-item>

            <x-nav.nav-item href="#" :isActive="false" aria-current="page">
              <x-slot name="icon">
                <x-heroicons.download class="ml-3 flex-shrink-0 h-6 w-6" />
              </x-slot>
              تقارير
            </x-nav.nav-item>
          </div>
          @can('viewAny', App\Models\User::class)
            <div class="mt-8">
              <!-- Secondary navigation -->
              <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider"
                id="management-headline">
                الإدارة
              </h3>
              <div class="mt-1 space-y-1" aria-labelledby="management-headline">
                <x-nav.nav-item href="{{ route('users.index') }}" :isActive="request()->routeIs('users.index')" aria-current="page">
                  <x-slot name="icon">
                    <x-heroicons.shield-check class="ml-3 flex-shrink-0 h-6 w-6" />
                  </x-slot>
                  الصلاحيات والمستخدمين
                </x-nav.nav-item>

                <x-nav.nav-item href="#" :isActive="false" aria-current="page">
                  <x-slot name="icon">
                    <x-heroicons.database class="ml-3 flex-shrink-0 h-6 w-6" />
                  </x-slot>
                  نسخ إحتياطي
                </x-nav.nav-item>
              </div>
            </div>
          @endcan

          <div class="mt-8">
            <!-- Secondary navigation -->
            <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider" id="desktop-tags-headline">
              التصنيفات</h3>
            <div class="mt-1 space-y-1" role="group" aria-labelledby="desktop-tags-headline">
              @foreach ($tags as $idx => $tag)
                <x-category-item href="{{ route('search', ['tag[0]' => $tag->id]) }}" :color="$tag->color">
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
            <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">{{ $pageTitle ?? 'default' }}</h1>
          </div>
          <x-dropdown>
            <x-slot name="button">
              @if ('admin' === 'admin')
                <div
                  class="max-w-xs bg-gray-700 p-1.5 text-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                  id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="sr-only">فتح قائمة المستخدم</span>
                  <svg class="w-5 h-5 rounded-full" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd"></path>
                  </svg>
                </div>
              @else
                <div
                  class="max-w-xs bg-white text-gray-700 flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                  id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="sr-only">فتح قائمة المستخدم</span>
                  <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                      clip-rule="evenodd"></path>
                  </svg>
                </div>
              @endif
            </x-slot>
            <div class="divide-y divide-gray-100">
              <div class="px-4 py-3" role="none">
                <p class="text-sm" role="none">تم تسجيل الدخول كـ</p>
                @if ('admin' === 'admin')
                  <p class="text-sm font-medium text-gray-900 truncate" role="none">{{ 'حساب الإدارة' }}</p>
                @else
                  <p class="text-sm font-medium text-gray-900 truncate" role="none">{{ 'علي سماري' }}</p>
                @endif
              </div>
              <div class="py-1" role="none">
                <form method="POST" action="{{ route('logout') }}" role="none">
                  @csrf()
                  <button type="submit" class="text-gray-700 block w-full text-right px-4 py-2 text-sm"
                    role="menuitem" tabindex="-1" id="menu-item-3">تسجيل خروج</button>
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
