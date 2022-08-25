@props([ 'tags' => [], 'fn' => fn ($tag) => false ])

<div class="divide-y divide-gray-200 pt-8 space-y-6 sm:pt-10 sm:space-y-5">
  <div>
    <h3 class="text-lg leading-6 font-medium text-gray-900">التصنيفات</h3>
    <p class="mt-1 max-w-2xl text-sm text-gray-500">إختيار تصنيف للملف.</p>
  </div>
  <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
    <div class="pt-6 sm:pt-5">
      <div role="group" aria-labelledby="tag">
        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
          <div>
            <div class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700"
              id="tag">التصنيف</div>
          </div>
          <div class="sm:col-span-2">
            <div class="max-w-lg">
              <div class="mt-4 space-y-4">
                @foreach ($tags as $tag)
                <div class="flex items-center">
                  <input id="tag-{{ $tag->id }}" name="tag_id" type="radio" required value="{{ $tag->id }}"
                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" @checked($fn($tag))>
                  <label for="tag-{{ $tag->id }}" class="mr-3 block text-sm font-medium text-gray-700">{{ $tag->name }}</label>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>