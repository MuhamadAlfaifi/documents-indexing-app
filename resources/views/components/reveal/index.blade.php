@props([ 'defaultValue' => false ])

<div x-data="{ isRevealed: '{{ $defaultValue }}' }" {{ $attributes }}>
  <button type="button" x-show="!isRevealed" x-on:click="isRevealed = ! isRevealed" class="flex items-center">{{ $button }}</button>
  <div x-cloak x-show="isRevealed">{{ $slot }}</div>
</div>