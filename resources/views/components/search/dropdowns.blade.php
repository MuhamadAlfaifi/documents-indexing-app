<div class="bg-white">
  <div class="text-center py-16 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">الملفات</h1>
  </div>

  <!-- Filters -->
  <section aria-labelledby="filter-heading">
    <h2 id="filter-heading" class="sr-only">الفلاتر</h2>

    <div class="relative z-10 bg-white border-b border-gray-200 pb-4">
      <div class="max-w-7xl mx-auto px-4 flex items-center justify-between sm:px-6 lg:px-8">
        <x-dropdown>
          <x-slot:button>
            <div class="flex">
              <div class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" id="menu-button" aria-expanded="false" aria-haspopup="true">
                فرز
                <!-- Heroicon name: solid/chevron-down -->
                <svg class="flex-shrink-0 -ml-1 mr-1 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </div>
            </div>
          </x-slot:button>
          <div class="py-1" role="none">
            <!--
              Active: "bg-gray-100", Not Active: ""

              Selected: "font-medium text-gray-900", Not Selected: "text-gray-500"
            -->
            <a href="#" class="font-medium text-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0"> Oldest </a>

            <a href="#" class="text-gray-500 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1"> Newest </a>
          </div>
        </x-dropdown>

        <div class="flow-root">
          <div class="-mx-4 flex items-center  divide-x-reverse divide-x divide-gray-200">
            <div class="px-4 text-left">
              <x-dropdown>
                <x-slot:button>
                  <div class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                    <span>التصنيفات</span>
    
                    <span class="mx-1.5 rounded py-0.5 px-1.5 bg-gray-200 text-xs font-semibold text-gray-700 tabular-nums">1</span>
                    <!-- Heroicon name: solid/chevron-down -->
                    <svg class="flex-shrink-0 -mr-1 ml-1 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                  </div>
                </x-slot:button>
                <form class="space-y-4">
                  <div class="flex items-center">
                    <input id="filter-category-0" name="category[]" value="new-arrivals" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-category-0" class="ml-3 pr-6 text-sm font-medium text-gray-900 whitespace-nowrap"> All New Arrivals </label>
                  </div>

                  <div class="flex items-center">
                    <input id="filter-category-1" name="category[]" value="tees" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-category-1" class="ml-3 pr-6 text-sm font-medium text-gray-900 whitespace-nowrap"> Tees </label>
                  </div>

                  <div class="flex items-center">
                    <input id="filter-category-2" name="category[]" value="objects" type="checkbox" checked class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-category-2" class="ml-3 pr-6 text-sm font-medium text-gray-900 whitespace-nowrap"> Objects </label>
                  </div>
                </form>
              </x-dropdown>
            </div>

            <div class="px-4 text-left">
              <x-dropdown>
                <x-slot:button>
                  <div class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                    <span>المستخدمين</span>
    
                    <span class="mx-1.5 rounded py-0.5 px-1.5 bg-gray-200 text-xs font-semibold text-gray-700 tabular-nums">10</span>
                    <!-- Heroicon name: solid/chevron-down -->
                    <svg class="flex-shrink-0 -mr-1 ml-1 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                  </div>
                </x-slot:button>
                <form class="space-y-4">
                  <div class="flex items-center">
                    <input id="filter-color-0" name="color[]" value="white" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-0" class="ml-3 pr-6 text-sm font-medium text-gray-900 whitespace-nowrap"> White </label>
                  </div>

                  <div class="flex items-center">
                    <input id="filter-color-1" name="color[]" value="beige" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-1" class="ml-3 pr-6 text-sm font-medium text-gray-900 whitespace-nowrap"> Beige </label>
                  </div>

                  <div class="flex items-center">
                    <input id="filter-color-2" name="color[]" value="blue" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-2" class="ml-3 pr-6 text-sm font-medium text-gray-900 whitespace-nowrap"> Blue </label>
                  </div>
                </form>
              </x-dropdown>
            </div>

            <div class="px-4 text-left">
              <x-dropdown>
                <x-slot:button>
                  <div class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                    <span>التاريخ</span>
    
                    <span class="mx-1.5 rounded py-0.5 px-1.5 bg-gray-200 text-xs font-semibold text-gray-700 tabular-nums">10</span>
                    <!-- Heroicon name: solid/chevron-down -->
                    <svg class="flex-shrink-0 -mr-1 ml-1 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                  </div>
                </x-slot:button>
                <form class="space-y-4">
                  <div class="flex items-center">
                    <input id="filter-sizes-0" name="sizes[]" value="s" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-sizes-0" class="ml-3 pr-6 text-sm font-medium text-gray-900 whitespace-nowrap"> S </label>
                  </div>

                  <div class="flex items-center">
                    <input id="filter-sizes-1" name="sizes[]" value="m" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-sizes-1" class="ml-3 pr-6 text-sm font-medium text-gray-900 whitespace-nowrap"> M </label>
                  </div>

                  <div class="flex items-center">
                    <input id="filter-sizes-2" name="sizes[]" value="l" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-sizes-2" class="ml-3 pr-6 text-sm font-medium text-gray-900 whitespace-nowrap"> L </label>
                  </div>
                </form>
              </x-dropdown>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Active filters -->
    <div class="bg-gray-100">
      <div class="max-w-7xl mx-auto py-3 px-4 sm:flex sm:items-center sm:px-6 lg:px-8">
        <h3 class="text-xs font-semibold uppercase tracking-wide text-gray-500">
          فلاتر
          <span class="sr-only">, مستخدم</span>
        </h3>

        <div aria-hidden="true" class="w-px h-5 bg-gray-300 mr-4"></div>

        <div class="mt-0 mr-4">
          <div class="-m-1 flex flex-wrap items-center">
            @foreach (range(1, 50) as $item)
            <span class="m-1 inline-flex rounded-full border border-gray-200 items-center py-1.5 pr-3 pl-2 text-sm font-medium bg-white text-gray-900">
              <span>كائنات</span>
              <button type="button" class="flex-shrink-0 mr-1 h-4 w-4 p-1 rounded-full inline-flex text-gray-400 hover:bg-gray-200 hover:text-gray-500">
                <span class="sr-only">إزالة فلتر</span>
                <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                  <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                </svg>
              </button>
            </span>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
