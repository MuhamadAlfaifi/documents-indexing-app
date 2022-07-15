<!-- This example requires Tailwind CSS v2.0+ -->
<div class="px-4 sm:px-6 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-xl font-semibold text-gray-900">الملفات</h1>
      <p class="mt-2 text-sm text-gray-700">جدول يعرض ملفات السنة الحالية</p>
    </div>
  </div>
  <div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="whitespace-nowrap py-3.5 pr-4 pl-3 text-right text-sm font-semibold text-gray-900 sm:pr-6">رقم الملف</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-right text-sm font-semibold text-gray-900">العنوان</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-right text-sm font-semibold text-gray-900">التصنيف</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-right text-sm font-semibold text-gray-900">تاريخ الإضافة</th>
                <th scope="col" class="relative whitespace-nowrap py-3.5 pr-3 pl-4 sm:pl-6">
                  <span class="sr-only">تعديل</span>
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
              @foreach (range(100, 200) as $item)
                <tr>
                  <td class="whitespace-nowrap py-2 pr-4 pl-3 text-sm text-gray-500 sm:pr-6">{{ $item }}</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">العنوان الملف رقم {{ $item }}</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-900">أعمال كهربائية</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">02:28:10 22-11-2022</td>
                  <td class="relative whitespace-nowrap py-2 pr-3 pl-4 text-left text-sm font-medium sm:pl-6 space-x-3 space-x-reverse">
                    <form class="inline" action="#" method="POST" onsubmit="return confirm('حذف الملف؟')">
                      @csrf()
                      @method('delete')
                      <button type="submit" class="text-red-600 hover:text-red-900">حذف<span
                          class="sr-only">, {{ $item }}</span></button>
                    </form>
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">تعديل<span
                        class="sr-only">, {{ $item }}</span></a>
                  </td>
                </tr>
              @endforeach

              <!-- More transactions... -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
