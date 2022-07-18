@props(['tags' => [], 'users' => []])

<div class="bg-white">
  <div class="text-center py-16 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">الملفات</h1>
  </div>

  <!-- Filters -->
  <section aria-labelledby="filter-heading">
    <h2 id="filter-heading" class="sr-only">الفلاتر</h2>

    <form action="{{ route('posts.index') }}" class="relative z-10 bg-white border-b border-gray-200 pb-4">
      <div class="max-w-7xl mx-auto px-4 flex items-center justify-between sm:px-6 lg:px-8">
        <x-dropdown alignment="right">
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
          <div class="py-1" role="menu">
            @foreach (['التاريخ', 'إسم الملف', 'رقم الملف', 'المستخدم'] as $idx => $field)
            <label class="text-gray-500 cursor-pointer hover:bg-gray-100 {{ $idx === 0 ? 'font-medium text-gray-900' : 'text-gray-500' }} block px-4 py-2 text-sm" role="menuitemradio" tabindex="-1"> 
              <input onchange="event.target.form.submit()" type="radio" name="sort" value="{{ join(',', [$field, 'desc']) }}" {{ request()->has('sort') ? '' : '' }} class="sr-only" />
              {{ $field }}: الأحدث 
            </label>
            
            <label class="text-gray-500 cursor-pointer hover:bg-gray-100 block px-4 py-2 text-sm" role="menuitemradio" tabindex="-1"> 
              <input onchange="event.target.form.submit()" type="radio" name="sort" value="{{ join(',', [$field, 'asc']) }}" class="sr-only" /> 
              {{ $field }}: الأقدم 
            </label>
            @endforeach
          </div>
        </x-dropdown>

        <div class="flow-root">
          <div class="-mx-4 flex items-center  divide-x-reverse divide-x divide-gray-200">
            <div class="px-4 text-left">
              <x-reveal :defaultValue="request()->searchable('q')">
                <x-slot:button>
                  <svg class="w-4 h-4 text-gray-400 hover:text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </x-slot:button>
                <div class="h-6">
                  <input type="text" name="q" value="{{ request()->searchable('q') }}" class="block w-full h-full border-0 border-b border-transparent rounded-md bg-gray-100 focus:border-indigo-600 focus:ring-0 sm:text-sm" placeholder="بحث اسم الملف">
                </div>
              </x-reveal>
            </div>
            
            <div class="px-4 text-left">
              <x-dropdown>
                <x-slot:button>
                  <div class="group space-x-reverse space-x-1.5 inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                    <span>التصنيفات</span>
    
                    @if(request()->has('tag'))
                    <span class="rounded py-0.5 px-1.5 bg-gray-200 text-xs font-semibold text-gray-700 tabular-nums">{{ count(request()->get('tag')) }}</span>
                    @endif
                    <!-- Heroicon name: solid/chevron-down -->
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                  </div>
                </x-slot:button>
                <ul class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" tabindex="-1" role="listbox">
                  @foreach ($tags as $tag)
                  <li class="text-gray-900 hover:bg-gray-100 cursor-pointer select-none relative py-2 pr-8 pl-4" role="option">
                    <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                    <label for="filter-tag-{{ $tag->id }}" class="font-normal cursor-pointer block truncate"> {{ $tag->name }} </label>
                    <input onchange="event.target.form.submit()" id="filter-tag-{{ $tag->id }}" name="tag[]" value="{{ $tag->id }}" type="checkbox" {{ !in_array($tag->id, request()->query('tag') ?? []) ?: 'checked' }} class="sr-only">
            
                    <!--
                      Checkmark, only display for selected option.
            
                      Highlighted: "text-white", Not Highlighted: "text-indigo-600"
                    -->
                    @if (in_array($tag->id, request()->query('tag') ?? []))
                    <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-1.5">
                      <!-- Heroicon name: solid/check -->
                      <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                      </svg>
                    </span>
                    @endif
                  </li>
                  @endforeach
                </ul>
              </x-dropdown>
            </div>

            <div class="px-4 text-left">
              <x-dropdown>
                <x-slot:button>
                  <div class="group space-x-reverse space-x-1.5 inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
                    <span>المستخدمين</span>
                    @if(request()->has('user'))
                    <span class="rounded py-0.5 px-1.5 bg-gray-200 text-xs font-semibold text-gray-700 tabular-nums">{{ count(request()->get('user')) }}</span>
                    @endif
                    <!-- Heroicon name: solid/chevron-down -->
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                  </div>
                </x-slot:button>
                <ul class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
                  @foreach ($users as $user)
                  <li class="text-gray-900 hover:bg-gray-100 cursor-pointer select-none relative py-2 pr-8 pl-4" id="listbox-option-0" role="option">
                    <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                    <label for="filter-user-{{ $user->id }}" class="font-normal cursor-pointer block truncate"> {{ $user->name }} </label>
                    <input onchange="event.target.form.submit()" id="filter-user-{{ $user->id }}" name="user[]" value="{{ $user->id }}" type="checkbox" {{ !in_array($user->id, request()->query('user') ?? []) ?: 'checked' }} class="sr-only">
            
                    <!--
                      Checkmark, only display for selected option.
            
                      Highlighted: "text-white", Not Highlighted: "text-indigo-600"
                    -->
                    @if (in_array($user->id, request()->query('user') ?? []))
                    <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-1.5">
                      <!-- Heroicon name: solid/check -->
                      <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                      </svg>
                    </span>
                    @endif
                  </li>
                  @endforeach
                </ul>
              </x-dropdown>
            </div>

            <div class="px-4 text-left">              
              <x-reveal :defaultValue="request()->query('date')">
                <x-slot:button>
                  <div class="space-x-reverse space-x-1.5 inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 [&>svg]:hover:text-gray-600">
                    <span class="">التاريخ</span>
                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                  </div>
                </x-slot:button>
                <x-datepicker.daterangepicker name="date" onchange="event.target.form.submit()" :selectedDate="request()->query('date', '2021-02-04')" />
              </x-reveal>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- Active filters -->
    @if(request()->searchable())
      <div class="bg-gray-100">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:flex sm:items-center sm:px-6 lg:px-8">
          <h3 class="text-xs font-semibold uppercase tracking-wide text-gray-500">
            فلاتر
            <span class="sr-only">, مستخدم</span>
          </h3>

          <div aria-hidden="true" class="w-px h-5 bg-gray-300 mr-4"></div>

          <div class="mt-0 mr-4">
            <div class="-m-1 flex flex-wrap items-center">
              @foreach (request()->searchable() as $key => $item)
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
    @endif
  </section>
</div>
