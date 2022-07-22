@props(['isActive' => false, 'icon' => null, 'href' => '#'])

<a href="{{ $href }}" @class([
    'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
    'bg-gray-200 text-gray-900' => $isActive,
    'text-gray-700 hover:text-gray-900 hover:bg-gray-50' => !$isActive,
]) aria-current="page">
  <!--
Heroicon name: outline/home

Current: "text-gray-500", Default: "text-gray-400 group-hover:text-gray-500"
-->
  @isset($icon)
    <span @class([
        'text-gray-500' => $isActive,
        'text-gray-400 group-hover:text-gray-500' => !$isActive,
    ])>{{ $icon }}</span>
  @endisset
  {{ $slot }}
</a>
