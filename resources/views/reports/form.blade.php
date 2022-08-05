@php
  $months = [
    0 => '',
    1 => 'يناير',
    2 => 'فبراير',
    3 => 'مارس',
    4 => 'أبريل',
    5 => 'مايو',
    6 => 'يونيو',
    7 => 'يوليو',
    8 => 'أغسطس',
    9 => 'سبتمبر',
    10 => 'أكتوبر',
    11 => 'نوفمبر',
    12 => 'ديسمبر',
  ];
@endphp

<x-app-layout>
  <x-slot name="pageTitle">
    إنشاء تقرير
  </x-slot>
  <form id="report-form" action="{{ route('report.download') }}" method="GET" class="p-8 max-w-xs">
    <div>
      <label for="month" class="block text-sm font-medium text-gray-700">اختر الشهر</label>
      <select id="month" name="month"
        class="mt-1 block w-full pr-3 pl-10 py-2 text-base bg-caret border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
        @foreach ($months as $key => $month)
          <option value="{{ $key }}">{{ $month }}</option>
        @endforeach
      </select>
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
</x-app-layout>
