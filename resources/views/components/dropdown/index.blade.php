@props(['alignment' => 'left'])

<div x-data="{ isOpen: false }" class="relative inline-block text-right">
  <div>
    <button x-on:click="isOpen = ! isOpen" type="button" id="menu-button" aria-expanded="true" aria-haspopup="true">
      {{ $button }}
    </button>
  </div>

  <div 
    x-cloak
    @click.outside="isOpen = false"
    x-show="isOpen"
    x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="transform opacity-100 scale-100"
    x-transition:leave-end="transform opacity-0 scale-95"
    class="{{ $alignment === 'right' ? 'origin-top-right' : 'origin-top-left' }} absolute {{ $alignment === 'right' ? 'right-0' : 'left-0' }} mt-2 w-56 rounded-md shadow-lg bg-white focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
    {{ $slot }}
  </div>
</div>
