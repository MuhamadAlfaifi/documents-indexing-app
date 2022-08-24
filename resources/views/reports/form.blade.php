@php
  $months = [
    0 => '',
    1 => 'محرم',
    2 => 'صفر',
    3 => 'ربيع الأول',
    4 => 'ربيع الثاني',
    5 => 'جمادى الأول',
    6 => 'جمادى الثاني',
    7 => 'رجب',
    8 => 'شعبان',
    9 => 'رمضان',
    10 => 'شوال',
    11 => 'ذو القعدة',
    12 => 'ذو الحجة',
  ];
  $users = \App\Models\User::all()->except(1);
  $years = range(\App\Models\Post::min('hijri_year'), \App\Models\Post::max('hijri_year'));
@endphp

<x-app-layout>
  <x-slot name="pageTitle">
    إنشاء تقرير
  </x-slot>
  <div class="p-8">
    <form id="report-form" x-data="
      { 
        elements: ['month', 'user_id', 'hijy'], 
        setName(kept, evt) { 
          var selectedIndex = evt.target.selectedIndex;

          this.elements.forEach(el => { 
            var node = document.getElementById(el);
            node.removeAttribute('name');
            node.selectedIndex = -1;
          });
          var node = document.getElementById(kept)
          node.setAttribute('name', kept);
          node.selectedIndex = selectedIndex;
        } 
      }
    " action="{{ route('report.download') }}" method="GET" class="w-full">
      <div class="flex w-full space-x-reverse space-x-20">
        <div class="max-w-xs">
          <label for="month" class="block text-sm font-medium text-gray-700">تقرير شهري</label>
          <select id="month" x-on:change="setName('month', $event)"
            class="mt-1 block w-full pr-3 pl-10 py-2 text-base bg-caret border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            @foreach ($months as $key => $month)
              <option value="{{ $key }}">{{ $month }}</option>
            @endforeach
          </select>
        </div>
        <div class="max-w-xs">
          <label for="user_id" class="block text-sm font-medium text-gray-700">تقرير مستخدم</label>
          <select id="user_id" x-on:change="setName('user_id', $event)"
            class="mt-1 block w-full pr-3 pl-10 py-2 text-base bg-caret border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            <option value=""></option>
            @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->username }}</option>
            @endforeach
          </select>
        </div>
        <div class="max-w-xs">
          <label for="hijy" class="block text-sm font-medium text-gray-700">تقرير سنوي</label>
          <select id="hijy" x-on:change="setName('hijy', $event)"
            class="mt-1 block w-full pr-3 pl-10 py-2 text-base bg-caret border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            <option value=""></option>
            @foreach ($years as $year)
              <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div>
        <input id="inline" type="hidden" name="inline" value="on" @disabled(true) />
      </div>
      <br />
      <div class="relative z-0 inline-flex shadow-sm rounded-md">
        <div x-data="{ on: false }" class="-mr-px relative block">
          <button type="button" x-on:click="on = !on"
            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
            id="option-menu-button" aria-expanded="true" aria-haspopup="true">
            <span class="sr-only">فتح الخيارات</span>
            <x-heroicons.chevron-down class="h-5 w-5" />
          </button>
  
          <div x-show="on" x-cloak @click.outside="on = false" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="origin-top-right absolute right-0 mt-2 -ml-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="option-menu-button" tabindex="-1">
            <div class="py-1" role="none">
              <button type="button" class="text-gray-700 hover:text-gray-900 hover:bg-gray-100 block px-4 py-2 text-sm w-full text-right"
                x-on:click="document.getElementById('inline').removeAttribute('disabled');document.getElementById('report-form').submit()"
                role="menuitem" tabindex="-1" id="option-menu-item-0"> عرض </button>
            </div>
          </div>
        </div>
        <button
          class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">تحميل PDF</button>
      </div>
    </form>
  </div>
</x-app-layout>
