@props(['tags' => []])

<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-white">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="preload" href="{{ asset('fonts/sf-arabic.ttf') }}" as="font" type="font/truetype" crossorigin="anonymous" />
  <style>
    @font-face {
      font-family: "sf-arabic";
      src: url("{{ asset('fonts/sf-arabic.ttf') }}");
      font-display: block;
    }
  </style>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased h-full">
  <div class="min-h-full">
    <!-- Static sidebar for desktop -->
    <div
      class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0 lg:border-r lg:border-gray-200 lg:pt-5 lg:pb-4 lg:bg-gray-100">
      <a href="/" class="flex items-center flex-shrink-0 px-6">
        <img class="h-8 w-auto" src="/logo.png" alt="الأرشيف الإلكتروني" />
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
              <x-button href="#" class="opacity-50">الماسح الضوئي</x-button>
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

            <x-nav.nav-item :href="route('search', ['user[0]' => auth()->user()->id])" :isActive="request()->fullUrl() === route('search', ['user[0]' => auth()->user()->id])" aria-current="page">
              <x-slot name="icon">
                <x-heroicons.view-list class="ml-3 flex-shrink-0 h-6 w-6" />
              </x-slot>
              ملفاتي
            </x-nav.nav-item>

            <x-nav.nav-item href="{{ route('report.form') }}" :isActive="request()->routeIs('report.form')" aria-current="page">
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
                    <x-heroicons.shield-check :solid="true" class="ml-3 flex-shrink-0 h-6 w-6" />
                  </x-slot>
                  الصلاحيات والمستخدمين
                </x-nav.nav-item>

                <x-nav.nav-item href="{{ route('backups.index') }}" :isActive="request()->routeIs('backups.index')" aria-current="page">
                  <x-slot name="icon">
                    <x-heroicons.database :solid="true" class="ml-3 flex-shrink-0 h-6 w-6" />
                  </x-slot>
                  نسخ إحتياطي
                </x-nav.nav-item>

                <x-nav.nav-item href="{{ route('tags.index') }}" :isActive="request()->routeIs('tags.index')" aria-current="page">
                  <x-slot name="icon">
                    <x-heroicons.tag :solid="true" class="ml-3 flex-shrink-0 h-6 w-6" />
                  </x-slot>
                  التصنيفات
                </x-nav.nav-item>
              </div>
            </div>
          @endcan

          @if(count($tags))
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
          @endif
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
          <x-dropdown class="w-8 h-8">
            <x-slot name="button">
              <div class="max-w-xs bg-white text-gray-700 flex items-center text-sm rounded-full" aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">فتح قائمة المستخدم</span>
                <x-heroicons.user-circle class="w-8 h-8 text-gray-700 hover:text-black" />
              </div>
            </x-slot>
            <div class="divide-y divide-gray-100">
              <div class="px-4 py-3" role="none">
                <p class="text-sm" role="none">تم تسجيل الدخول كـ</p>
                <p class="text-sm font-medium text-gray-900 truncate" role="none">{{ auth()->user()->username }}</p>
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

        <x-validation-errors class="p-8" />

        @if(session()->has('error'))
          <div class="p-8">
            <x-alert.error>{{ session()->get('error') }}</x-alert.error>
          </div>
        @endif

        @if(session()->has('success'))
          <div class="p-8">
            <x-alert.success>{{ session()->get('success') }}</x-alert.success>
          </div>
        @endif

        {{ $slot }}
      </main>
    </div>
  </div>
</body>

</html>
