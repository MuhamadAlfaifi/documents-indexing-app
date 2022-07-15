<div class="px-4 sm:px-6 lg:px-8">
  <div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle">
        <div class="shadow-sm ring-1 ring-black ring-opacity-5">
          <table class="min-w-full border-separate" style="border-spacing: 0">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pr-4 pl-3 text-right text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8">رقم الملف</th>
                <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-right text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">عنوان الملف</th>
                <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-right text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">التصنيف</th>
                <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-right text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">من قبل</th>
                <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-right text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">تاريخ الإضافة</th>
                <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">
                  <span class="sr-only">تعديل</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white">
              @foreach (range(100, 200) as $item)    
              <tr>
                <td class="whitespace-nowrap border-b border-gray-200 py-4 pr-4 pl-3 text-sm font-medium text-gray-900 sm:pr-6 lg:pr-8">{{ $item }}</td>
                <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500 hidden sm:table-cell">عنوان الملف {{ $item }}</td>
                <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500 hidden lg:table-cell">أعمال كهربائية</td>
                <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500">علي</td>
                <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500">02:28:10 22-11-2022</td>
                <td class="relative space-x-reverse space-x-3 whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-left text-sm font-regular sm:pl-6 lg:pl-8">
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

              <!-- More people... -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
