@props([ 'href' => '#' ])

<span class="m-1 inline-flex rounded-full border border-gray-200 items-center py-1.5 pr-3 pl-2 text-sm font-medium bg-white text-gray-900">
  <span>{{ $slot }}</span>
  <a href="{{ $href }}" class="flex-shrink-0 mr-1 h-4 w-4 p-1 rounded-full inline-flex text-gray-400 hover:bg-gray-200 hover:text-gray-500">
    <span class="sr-only">إزالة فلتر</span>
    <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
      <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
    </svg>
  </a>
</span>