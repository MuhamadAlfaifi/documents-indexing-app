@props(['name' => 'date', 'selectedDate' => ''])

<div class="h-6">
  <div id="" class="block relative text-center px-2 w-full h-full border-0 border-b border-transparent rounded-md bg-gray-100 focus:border-indigo-600 focus:ring-0 sm:text-sm">
    <div class="w-52 relative top-1/2 -translate-y-1/2"></div>
    <input type="date" onchange="event.target.form.submit()" name="{{ $name }}" />
  </div>
</div>
