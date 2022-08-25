@props([ 'day' => '', 'month' => '', 'year' => '' ])

<div class="divide-y divide-gray-200 pt-8 space-y-6 sm:pt-10 sm:space-y-5">
  <div>
    <h3 class="text-lg leading-6 font-medium text-gray-900">التاريخ</h3>
    <p class="mt-1 max-w-2xl text-sm text-gray-500">تاريخ المستند.</p>
  </div>
  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
    <div class="pt-6 sm:pt-5">
      <div role="group" aria-labelledby="date">
        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
          <div>
            <div class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
              id="date">هجري</div>
          </div>
          <div class="sm:col-span-2">
            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6 max-w-xs">
              <div class="sm:col-span-2">
                <label for="hijri-day" class="block text-sm font-medium text-gray-700 asterisk"> اليوم </label>
                <div class="mt-1">
                  <input type="number" name="hijri[]" id="hijri-day" min="0" value="{{ $day }}" required class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
              </div>
      
              <div class="sm:col-span-2">
                <label for="hijri-month" class="block text-sm font-medium text-gray-700 asterisk"> الشهر </label>
                <div class="mt-1">
                  <input type="number" name="hijri[]" id="hijri-month" min="0" value="{{ $month }}" required class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
              </div>
      
              <div class="sm:col-span-2">
                <label for="hijri-year" class="block text-sm font-medium text-gray-700 asterisk"> السنة </label>
                <div class="mt-1">
                  <input type="number" name="hijri[]" id="hijri-year" min="0" value="{{ $year }}" required class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>