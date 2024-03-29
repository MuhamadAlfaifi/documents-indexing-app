<x-app-layout>
  <x-slot name="pageTitle">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Create New Tag') }}
    </h2>
  </x-slot>

  <x-breadcrumbs home="الإدارة" :steps="[
    [route('tags.index'), 'التصنيفات'],
    [route('tags.create'), 'إنشاء تصنيف جديد']
  ]" class="mx-8 mt-6" />

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium leading-6 text-gray-900">معلومات التصنيف</h3>
              <p class="mt-1 text-sm text-gray-600">يجب أن يكون إسم التصنيف فريد.</p>
            </div>
          </div>
          <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{ $action }}" autocomplete="off" method="POST">
              @csrf()
              @method($method)
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6 space-y-5">
                  <div>
                    <label for="tag-name" class="block text-sm font-medium text-gray-700">اسم التصنيف</label>
                    <input type="text" name="name" id="tag-name" value="{{ old('name') }}"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>
                  <div>
                    <label for="tag-description" class="block text-sm font-medium text-gray-700">وصف التصنيف</label>
                    <textarea rows="4" name="description" id="tag-description"
                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                  </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                  <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('Save') }}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
