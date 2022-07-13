<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('معلومات التصنيف') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl bg-white mx-auto sm:px-6 lg:px-8">
      <div>
        <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $tag->name }}</h3>
      </div>
      <div class="mt-5 border-t border-gray-200">
        <dl class="divide-y divide-gray-200">
          <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
            <dt class="text-sm font-medium text-gray-500">name</dt>
            <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <span class="flex-grow">{{ $tag->name }}</span>
              <span class="mr-4 flex-shrink-0">
                <a href="{{ route('tags.create') }}"
                  class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</a>
              </span>
            </dd>
          </div>
          <div class="py-4 sm:grid sm:py-5 sm:grid-cols-3 sm:gap-4">
            <dt class="text-sm font-medium text-gray-500">Posts</dt>
            <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <span class="flex-grow">{{ count($tag->posts) }}</span>
            </dd>
          </div>
          <div class="py-4 sm:grid sm:py-5 sm:grid-cols-3 sm:gap-4">
            <dt class="text-sm font-medium text-gray-500">Users</dt>
            <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <span class="flex-grow">{{ count($tag->posts) }}</span>
            </dd>
          </div>
          <div class="py-4 sm:grid sm:py-5 sm:grid-cols-3 sm:gap-4">
            <dt class="text-sm font-medium text-gray-500">Description</dt>
            <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <span class="flex-grow">{{ $tag->description }}</span>
              <span class="mr-4 flex-shrink-0">
                <a href="{{ route('tags.create') }}"
                  class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</a>
              </span>
            </dd>
          </div>
        </dl>
      </div>
    </div>
  </div>
</x-app-layout>
