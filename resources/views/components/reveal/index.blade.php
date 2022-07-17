@props([ 'defaultValue' => null ])

<div x-data="{ isRevealed: {{ is_null($defaultValue) ? 'false' : 'true' }} }" {{ $attributes }}>
  <button type="button" x-show="!isRevealed" x-on:click="isRevealed = ! isRevealed" class="flex items-center">{{ $button }}</button>
  <div x-cloak x-show="isRevealed">{{ $slot }}</div>
</div>