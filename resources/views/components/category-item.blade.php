@props(['href' => '#', 'color' => '#c3c3c3'])

<a href="{{ $href }}" @class([
  'group flex items-center px-3 py-2 text-sm font-medium rounded-md hover:text-gray-900 hover:bg-gray-50',
  'text-gray-700' => request()->fullUrl() !== $href,
  'text-gray-900 bg-gray-200' => request()->fullUrl() === $href,
]) data-debug-1="{{ request()->fullUrl() }}" data-debug-2="{{ $href }}">
  <span style="background-color: {{ $color }}" class="w-2.5 h-2.5 ml-4 rounded-full" aria-hidden="true"></span>
  <span class="truncate"> {{ $slot }} </span>
</a>