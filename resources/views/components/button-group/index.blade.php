<div class="relative z-0 inline-flex shadow-sm rounded-md">
  <div x-data="{ isGrpBtnOpn: false }" class="-mr-px relative block">
    <button x-on:click="isGrpBtnOpn = ! isGrpBtnOpn" type="button" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500" id="option-menu-button" aria-expanded="true" aria-haspopup="true">
      <span class="sr-only">خيارات أخرى</span>
      <!-- Heroicon name: solid/chevron-down -->
      <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
      </svg>
    </button>
    <div 
      x-show="isGrpBtnOpn" 
      x-transition:enter="transition ease-out duration-100"
      x-transition:enter-start="transform opacity-0 scale-95"
      x-transition:enter-end="transform opacity-100 scale-100"
      x-transition:leave="transition ease-in duration-75"
      x-transition:leave-start="transform opacity-100 scale-100"
      x-transition:leave-end="transform opacity-0 scale-95"
      class="origin-top-right absolute right-0 mt-2 -ml-1 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="option-menu-button" tabindex="-1">
      <div class="py-1" role="none">
        {{ $secondary }}
      </div>
    </div>
  </div>
  {{ $primary }}
</div>
