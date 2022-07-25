<x-app-layout>
  <x-slot name="pageTitle">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('التصنيفات') }}
    </h2>
  </x-slot>
  <x-breadcrumbs home="الإدارة" :steps="[[route('tags.index'), 'التصنيفات']]" class="mx-8 mt-6" />
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-xl font-semibold text-gray-900">التصنيفات</h1>
          <p class="mt-2 text-sm text-gray-700">جدول يستعرض جميع التصنيفات.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:mr-16 sm:flex-none">
          <a href="{{ route('tags.create') }}"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">إنشاء تصنيف</a>
        </div>
      </div>
      <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
              <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="py-3.5 pr-4 pl-3 text-right text-sm font-semibold text-gray-900 sm:pr-6">رقم</th>
                    <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900">الإسم</th>
                    <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900">الوصف</th>
                    <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900">تاريخ الإنشاء</th>
                    <th scope="col" class="relative py-3.5 pr-3 pl-4 sm:pl-6">
                      <span class="sr-only">تعديل</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  @foreach ($tags as $tag)
                    <tr>
                      <td class="whitespace-nowrap py-4 pr-4 pl-3 text-sm font-medium text-gray-900 sm:pr-6">{{ $tag->id }}</td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <a href="{{ route('tags.show', ['tag' => $tag->id]) }}" class="truncate hover:text-gray-600">
                          {{ $tag->name }}
                        </a>
                      </td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $tag->description }}</td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $tag->created_at }}</td>
                      <td class="relative whitespace-nowrap py-4 pr-3 pl-4 text-left text-sm font-medium sm:pl-6 space-x-3 space-x-reverse">
                        <form class="inline" action="{{ route('tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('حذف التصنيف؟')">
                          @csrf()
                          @method('delete')
                          <button type="submit" class="text-red-600 hover:text-red-900">حذف<span
                              class="sr-only">, {{ $tag->name }}</span></button>
                        </form>
                        <a href="{{ route('tags.edit', ['tag' => $tag->id]) }}" class="text-indigo-600 hover:text-indigo-900">تعديل<span
                            class="sr-only">, {{ $tag->name }}</span></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</x-app-layout>
