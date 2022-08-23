<x-app-layout :tags="$tags">
  <x-slot name="pageTitle">عرض ملف</x-slot>

  <div class="grid grid-cols-12">
    <div class="bg-white col-span-8">
      <!-- This example requires Tailwind CSS v2.0+ -->
      <div class="bg-white overflow-hidden rounded-lg border px-8 py-1 m-8">
        <div class="py-5 px-6">
          <h3 class="text-lg leading-6 font-medium text-gray-900">معلومات "{{ $post->title }}"</h3>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
          <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">رقم المستند</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $post->no }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">العنوان</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $post->title }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">الموضوع</dt>
              <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <span class="flex-grow">{{ $post->topic }}</span>
                <span class="ml-4 flex-shrink-0">
                  @can('update', $post)
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">تعديل</a>
                  @endcan
                </span>
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">التصنيف</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center">
                @foreach ($post->tags as $tag)  
                  <div style="background-color: {{ $tag->color }}" class="flex-shrink-0 w-2.5 h-2.5 rounded-full" aria-hidden="true"></div>
                  <div class="mr-2">{{ $tag->name }}</div>
                @endforeach
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">أضيف من قبل</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $post->user->username }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">التاريخ</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ join(' / ', $post->hijri) }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">الكلمات المفتاحية</dt>
              <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <span class="flex-grow">{{ $post->keywords }}</span>
                <span class="ml-4 flex-shrink-0">
                  @can('update', $post)
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">تعديل</a>
                  @endcan
                </span>
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">المستندات</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                  @foreach ($post->getMedia('default') as $media)
                    <li class="pr-3 pl-4 py-3 flex items-center justify-between text-sm">
                      <div class="w-0 flex-1 flex items-center">
                        <!-- Heroicon name: solid/paper-clip -->
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd"
                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                            clip-rule="evenodd" />
                        </svg>
                        <span class="mr-2 flex-1 w-0 truncate"> {{ join(' - ', [$post->title, $post->created_at]) }} </span>
                      </div>
                      <div class="mr-4 flex-shrink-0">
                        <a href="{{ $media->getUrl() }}" download="{{ join(' - ', [$post->title, $post->created_at]) }}" class="font-medium text-indigo-600 hover:text-indigo-500"> تحميل </a>
                      </div>
                    </li>
                  @endforeach
                </ul>
              </dd>
            </div>
          </dl>
        </div>
      </div>
    </div>
    
    <!-- file preview -->
    <div class="relative z-10 bg-white pb-4 col-span-4">
      <div class="max-w-7xl mx-auto px-8 mt-8 relative">
        <div class="absolute top-0 text-center text-sm w-16 h-5 shadow-sm rounded-b-md bg-zinc-600 text-gray-200">معاينة</div>
        @foreach ($post->getMedia('default') as $media)
          <embed type="{{ $media->mime_type }}" src="{{ $media->getUrl() }}" class="rounded-lg border h-96 w-full" width="100%" />
        @endforeach
      </div>
    </div>
  </div>
  @can('delete', $post)
  <div class="md:grid md:grid-cols-3 mt-10 md:gap-6 border-2 border-red-500 rounded-lg m-8">
    <div class="md:col-span-1">
      <div class="p-3">
        <h3 class="text-lg font-medium leading-6 text-red-500">حذف</h3>
        <p class="mt-1 text-sm text-gray-600">لا يمكن التراجع عن المستندات المحذوفة</p>
        <form class="inline-block mt-4" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" onsubmit="return confirm('حذف المستند؟')">
          @csrf()
          @method('delete')
          <button type="submit" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">حذف</button>
        </form>
      </div>
    </div>
  </div>
  @endcan
</x-app-layout>
