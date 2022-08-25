@props([ 'title' => '', 'no' => '', 'topic' => '', 'keywords' => '', 'suggestedKeywords' => '' ])

<div>
  <div>
    <h3 class="text-lg leading-6 font-medium text-gray-900">البيانات الوصفية</h3>
    <p class="mt-1 max-w-2xl text-sm text-gray-500">هذه البيانات يتم إستخدامها للأرشفة والبحث.</p>
  </div>

  <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
      <label for="title" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 asterisk"> العنوان
      </label>
      <div class="mt-1 sm:mt-0 sm:col-span-2">
        <input id="title" name="title" type="text" autocomplete="title" value="{{ $title }}" required
          class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
      </div>
    </div>
    
    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
      <label for="no" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 asterisk"> الرقم
      </label>
      <div class="mt-1 sm:mt-0 sm:col-span-2">
        <input id="no" name="no" type="text" autocomplete="no" value="{{ $no }}" required
          class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
      </div>
    </div>
    
    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
      <label for="topic" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 asterisk"> الموضوع
      </label>
      <div class="mt-1 sm:mt-0 sm:col-span-2">
        <input id="topic" name="topic" type="text" autocomplete="topic" value="{{ $topic }}" required
          class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
      </div>
    </div>

    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
      <label for="keywords" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 asterisk"> كلمات مفتاحية </label>
      <div class="mt-1 sm:mt-0 sm:col-span-2">
        <textarea id="keywords" name="keywords" rows="3"
          class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md">{{ $keywords ?? $suggestedKeywords }}</textarea>
      </div>
    </div>
  </div>
</div>