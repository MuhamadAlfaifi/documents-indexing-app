@props(['tags' => [], 'users' => []])

<div class="bg-white">
  <div class="text-center py-16 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">الملفات</h1>
  </div>

  <!-- Filters -->
  <section aria-labelledby="filter-heading">
    <h2 id="filter-heading" class="sr-only">الفلاتر</h2>

    <form action="{{ route('search') }}" class="relative z-10 bg-white border-b border-gray-200 pb-4">
      <div class="max-w-7xl mx-auto px-4 flex items-center justify-between sm:px-6 lg:px-8">
        <x-dropdown alignment="right">
          <x-slot:button>
            <div class="flex">
              <div class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" id="menu-button" aria-expanded="false" aria-haspopup="true">
                فرز
                <x-heroicons.chevron-down class="flex-shrink-0 -ml-1 mr-1 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
              </div>
            </div>
          </x-slot:button>
          <x-dropdown.menu>
            @foreach (['created_at' => 'التاريخ', 'title' => 'إسم الملف', 'id' => 'رقم الملف'] as $idx => $field)
              <x-dropdown.menu-item>
                <x-input.menu 
                  :checked="request()->query('sort', 'created_at,desc') === join(',', ([$idx,'desc']))" 
                  role="menuitemradio"
                  type="radio"
                  name="sort"
                  value="{{ join(',', [$idx, 'desc']) }}"
                  submit
                >
                  {{ $field }}: {{ __("search-forms.$idx-desc") }}
                </x-input.menu>
              </x-dropdown.menu-item>
              
              <x-dropdown.menu-item>
                <x-input.menu 
                  :checked="request()->query('sort', 'created_at,desc') === join(',', ([$idx,'asc']))" 
                  role="menuitemradio"
                  type="radio"
                  name="sort"
                  value="{{ join(',', [$idx, 'asc']) }}"
                  submit
                >
                  {{ $field }}: {{ __("search-forms.$idx-asc") }}
                </x-input.menu>
              </x-dropdown.menu-item>
            @endforeach
          </x-dropdown.menu>
        </x-dropdown>

        <div class="flow-root">
          <div class="-mx-4 flex items-center  divide-x-reverse divide-x divide-gray-200">
            <div class="px-4 text-left">
              <x-reveal :defaultValue="request()->has('query')">
                <x-slot:button>
                  <x-heroicons.search class="w-4 h-4 text-gray-400 hover:text-gray-600" />
                </x-slot:button>
                <div class="h-6">
                  <x-input.search />
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
                    <x-heroicons.chevron-down class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                  </div>
                </x-slot:button>
                <x-dropdown.menu class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" tabindex="0" aria-label="tags-dropdown-menu">
                  @foreach ($tags as $tag)
                  <x-dropdown.menu-item class="relative">
                    <x-input.menu 
                      :checked="in_array($tag->id, request()->query('tag') ?? [])" 
                      role="menuitemcheckbox"
                      type="checkbox"
                      name="tag[]"
                      value="{{ $tag->id }}"
                      submit
                    >
                      <x-slot:icon>
                        <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-1.5">
                          <x-heroicons.check class="h-5 w-5" />
                        </span>
                      </x-slot:icon>
                      {{ $tag->name }}
                    </x-input.menu>
                  </x-dropdown.menu-item>
                  @endforeach
                </x-dropdown.menu>
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
                    <x-heroicons.chevron-down class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                  </div>
                </x-slot:button>
                <x-dropdown.menu class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" tabindex="0" aria-label="users-dropdown-menu">
                  @foreach ($users as $user)
                  <x-dropdown.menu-item class="relative">
                    <x-input.menu 
                      :checked="in_array($user->id, request()->query('user') ?? [])" 
                      role="menuitemcheckbox"
                      type="checkbox"
                      name="user[]"
                      value="{{ $user->id }}"
                      submit
                    >
                      <x-slot:icon>
                        <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-1.5">
                          <x-heroicons.check class="h-5 w-5" />
                        </span>
                      </x-slot:icon>
                      {{ $user->name }}
                    </x-input.menu>
                  </x-dropdown.menu-item>
                  @endforeach
                </x-dropdown.menu>
              </x-dropdown>
            </div>

            <div class="px-4 text-left">              
              <x-reveal :defaultValue="request()->has('date')">
                <x-slot:button>
                  <div class="space-x-reverse space-x-1.5 inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 [&>svg]:hover:text-gray-600">
                    <span class="">التاريخ</span>
                    <x-heroicons.calendar class="h-4 w-4 text-gray-400" />
                  </div>
                </x-slot:button>
                <x-datepicker.daterangepicker name="date" onchange="event.target.form.submit()" :selectedDate="request()->query('date')" />
              </x-reveal>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- Active filters -->
    @if(!empty(request()->filters()))
      <div class="bg-gray-100">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:flex sm:items-center sm:px-6 lg:px-8">
          <h3 class="text-xs font-semibold uppercase tracking-wide text-gray-500">
            فلاتر
            <span class="sr-only">, مستخدم</span>
          </h3>

          <div aria-hidden="true" class="w-px h-5 bg-gray-300 mr-4"></div>

          <div class="mt-0 mr-4">
            <div class="-m-1 flex flex-wrap items-center">
              @foreach (request()->filters() as [$key, $value, $unfilter])
                @if($key === 'query')
                  <x-search.active-filter :href="$unfilter">{{ $value }}</x-search.active-filter>
                @elseif($key === 'date')
                  <x-search.active-filter :href="$unfilter">date: {{ $value }}</x-search.active-filter>
                @elseif($key === 'tag')
                  <x-search.active-filter :href="$unfilter">{{ optional($tags->find($value))->name }}</x-search.active-filter>
                @elseif($key === 'user')
                  <x-search.active-filter :href="$unfilter">{{ optional($users->find($value))->name }}</x-search.active-filter>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    @endif
  </section>
</div>
