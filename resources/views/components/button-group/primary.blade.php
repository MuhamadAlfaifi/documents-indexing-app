<a href="{{ $attributes['href'] }}" class="{{ $attributes['active'] === true ? 'text-gray-900 bg-gray-100' : 'text-gray-700 bg-white' }} relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 text-sm font-medium hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">{{ $slot }}</a>