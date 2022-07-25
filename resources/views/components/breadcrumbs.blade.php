@props([
    'steps' => [[route('tags.index'), 'التصنيفات'], [route('tags.show', ['tag' => 10]), 'عامل جديد']],
    'home' => null,
])

<nav @class(['flex', $attributes['class']]) aria-label="Breadcrumb">
  <ol role="list" class="flex items-center  space-x-reverse space-x-4">
    <li>
      <div>
        @if ($home)
          <p class="text-gray-400 hover:text-gray-500">{{ $home }}</p>
        @else
          <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-500">
            <x-heroicons.home solid class="flex-shrink-0 h-5 w-5" />
            <span class="sr-only">الرئيسية</span>
          </a>
        @endif
      </div>
    </li>

    @foreach ($steps as $step)
      <li>
        <div class="flex items-center">
          <x-heroicons.chevron-left solid class="flex-shrink-0 h-5 w-5 text-gray-400" />
          <a href="{{ $step[0] }}"
            class="mr-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ $step[1] }}</a>
        </div>
      </li>
    @endforeach
  </ol>
</nav>
