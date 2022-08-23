@props([ 'name' => 'query', 'type' => 'text', 'value' => request()->query('query'), 'placeholder' => 'بحث اسم أو موضوع المستند' ])

<input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" @class([
  'block w-full h-full border-0 border-b border-transparent rounded-md bg-gray-100 focus:border-indigo-600 focus:ring-0 sm:text-sm',
  $attributes['class'],
]) {{ $attributes }} />