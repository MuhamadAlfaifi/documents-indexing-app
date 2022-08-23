<x-app-layout :tags="$tags">
  <x-slot name="pageTitle">الرئيسية</x-slot>

  <!-- Search Filters -->
  <x-search.filters :tags="$tags" :users="$users" />
  
  <div class="px-8 my-4">
    {{ $posts->links() }}
  </div>

  <!-- Items table -->
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col">
      <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle">
          <div class="shadow-sm ring-1 ring-black ring-opacity-5">
            <table class="min-w-full border-separate" style="border-spacing: 0">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pr-4 pl-3 text-right text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8">رقم الملف</th>
                  <th scope="col" class="border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-right text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">اسم الملف</th>
                  <th scope="col" class="border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-right text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">المستخدم</th>
                  <th scope="col" class="border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-right text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">تاريخ</th>
                  <th scope="col" class="border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">
                    <span class="sr-only">تعديل</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white">
                @foreach ($posts as $post)
                <tr>
                  <td class="whitespace-nowrap border-b border-gray-200 py-4 pr-4 pl-3 text-sm font-medium text-gray-900 sm:pr-6 lg:pr-8">{{ $post->no }}</td>
                  <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm">
                    <div class="flex items-center space-x-reverse space-x-3 pl-2">
                      @foreach ($post->tags as $tag)  
                        <div style="background-color: {{ $tag->color }}" class="flex-shrink-0 w-2.5 h-2.5 rounded-full" aria-hidden="true"></div>
                      @endforeach
                      <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="truncate hover:text-gray-600">
                        <span>
                          {{ $post->title }}
                          @foreach ($post->tags as $tag)  
                            <span class="text-gray-500 font-normal">في {{ $tag->name }}</span>
                          @endforeach
                        </span>
                      </a>
                    </div>
                  </td>
                  <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500">{{ $post->user->username }}</td>
                  <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500">{{ join(' / ', $post->hijri) }}</td>
                  <td class="relative space-x-reverse space-x-3 whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-left text-sm font-regular sm:pl-6 lg:pl-8">
                    
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

</x-app-layout>
