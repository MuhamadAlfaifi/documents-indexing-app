<ul @class([
  'py-1 divide-y divide-gray-100',
  $attributes['class'],
]) {{ $attributes }} role="menu">
  {{ $slot }}
</ul>