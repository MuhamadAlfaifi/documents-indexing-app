<x-app-layout>
  <x-slot:pageTitle>مستند جديد</x-slot:pageTitle>

  <div class="mt-6"></div>

  <form action="{{ route('posts.store', ['tmp' => request()->get('tmp')]) }}" method="POST" class="space-y-8 divide-y divide-gray-200 px-8">
    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
      <div>
        <div>
          <h3 class="text-lg leading-6 font-medium text-gray-900">البيانات الوصفية</h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">هذه البيانات يتم إستخدامها للأرشفة والبحث.</p>
        </div>

        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="title" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> عنوان
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <input id="title" name="title" type="text" autocomplete="title" required
                class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="description" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> الوصف </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <textarea id="description" name="description" rows="3"
                class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"></textarea>
              <p class="mt-2 text-sm text-gray-500">(اختياري)</p>
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="keywords" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> كلمات مفتاحية </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <textarea id="keywords" name="keywords" rows="3"
                class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md">{{ $suggestedKeywords }}</textarea>
              <p class="mt-2 text-sm text-gray-500">(اختياري)</p>
            </div>
          </div>
        </div>
      </div>

      <div class="divide-y divide-gray-200 pt-8 space-y-6 sm:pt-10 sm:space-y-5">
        <div>
          <h3 class="text-lg leading-6 font-medium text-gray-900">التصنيفات</h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">إختيار تصنيف للملف.</p>
        </div>
        <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
          <div class="pt-6 sm:pt-5">
            <div role="group" aria-labelledby="tag">
              <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                <div>
                  <div class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
                    id="tag">التصنيف</div>
                </div>
                <div class="sm:col-span-2">
                  <div class="max-w-lg">
                    <div class="mt-4 space-y-4">
                      @foreach ($tags as $tag)
                      <div class="flex items-center">
                        <input id="tag-{{ $tag->id }}" name="tag_id" type="radio" required value="{{ $tag->id }}"
                          class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                        <label for="tag-{{ $tag->id }}" class="mr-3 block text-sm font-medium text-gray-700">{{ $tag->name }}</label>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @csrf()

    <div class="pt-5">
      <div class="flex justify-end">
        <button type="button"
          class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">إلغاء</button>
        <button type="submit"
          class="mr-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">حفظ</button>
      </div>
    </div>
  </form>

  <div class="mt-48"></div>
</x-app-layout>