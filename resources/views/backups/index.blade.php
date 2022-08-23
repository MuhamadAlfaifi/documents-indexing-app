<x-app-layout>
  <x-slot name="pageTitle">نسخ احتياطي</x-slot>
  <div class="py-8 pb-32 px-8">
    <div class="max-w-xl">
      <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">النسخ الإحتياطية</h1>
      <p class="mt-2 text-sm text-gray-500">وقت إنشاء نسخة إحتياطية جديدة سيستغرق بضع دقائق.</p>
    </div>

    <div class="mt-12 space-y-16 sm:mt-16">
      <section aria-labelledby="4376-heading">
        <div class="space-y-1 md:flex md:items-baseline md:space-y-0 md: space-x-reverse space-x-4">
          <h2 id="4376-heading" class="text-lg font-medium text-gray-900 md:flex-shrink-0">آخر نسخة إحتياطية</h2>
          <div class="space-y-5 md:flex-1 md:min-w-0 sm:flex sm:items-baseline sm:justify-between sm:space-y-0">
            @if($latest)
              <p class="text-sm font-medium text-gray-500">أنشئت {{ $latest->created_at->diffForHumans() }}</p>
            @else
              <p class="text-sm font-medium text-gray-500">لا يوجد.</p>
            @endif
            <div class="flex text-sm font-medium">
              <a href="{{ route('backups.create') }}" class="text-indigo-600 hover:text-indigo-500">إنشاء نسخة أحتياطية</a>
            </div>
          </div>
        </div>

        <div class="mt-6 -mb-6 flow-root border-t border-gray-200 divide-y divide-gray-200">
          @foreach ($backups as $backup)
            <div class="py-6 sm:flex">
              <div
                class="flex  space-x-reverse space-x-4 sm:min-w-0 sm:flex-1 sm: space-x-reverse space-x-6 lg: space-x-reverse space-x-8">
                <x-heroicons.database solid
                  class="flex-none w-20 h-20 rounded-md sm:w-48 sm:h-48 text-zinc-700" />
                <div class="pt-1.5 min-w-0 flex-1 sm:pt-0">
                  <h3 class="text-sm font-medium text-gray-900">
                    <bdi>{{ $backup->filename }}</bdi>
                  </h3>
                  <p class="mt-1 font-medium text-gray-900"><bdi>{{ $backup->sizeForHumans() }}</bdi></p>
                </div>
              </div>
              <div class="mt-6 space-y-4 sm:mt-0 sm:mr-6 sm:flex-none sm:w-40">
                <a href="{{ $backup->url() }}" download="{{ $backup->filename }}"
                  class="w-full flex items-center justify-center bg-indigo-600 py-2 px-2.5 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-full sm:flex-grow-0">تنزيل</a>
              </div>
            </div>
          @endforeach

          <!-- More products... -->
        </div>
      </section>

      <!-- More orders... -->
    </div>
  </div>
</x-app-layout>
