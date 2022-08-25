@props([ 'action' => '', 'method' => '' ])

@php
  $htmlMethod = '';

  switch(strtolower($method)) {
    case 'put':
      $htmlMethod = 'post';
      break;
    case 'delete':
      $htmlMethod = 'post';
      break;
    default:
      $htmlMethod = 'get';
      break;
  }
@endphp

<div class="mt-6"></div>

<form action="{{ $action }}" method="{{ $htmlMethod }}" class="space-y-8 divide-y divide-gray-200 px-8">
  <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
    {{ $slot }}
  </div>
  @csrf()
  @method($method)

  <div class="pt-5">
    <div class="flex justify-end">
      {{-- <button type="button"
        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">إلغاء</button> --}}
      <button type="submit"
        class="mr-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">حفظ</button>
    </div>
  </div>
</form>

<div class="mt-48"></div>