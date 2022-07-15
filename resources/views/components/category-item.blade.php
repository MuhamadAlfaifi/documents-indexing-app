<a href="{{ $attributes['href'] }}"
  class="group flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">
  <span class="w-2.5 h-2.5 ml-4 {{ $attributes['bg'] }} rounded-full" aria-hidden="true"></span>
  <span class="truncate"> {{ $slot }} </span>
</a>