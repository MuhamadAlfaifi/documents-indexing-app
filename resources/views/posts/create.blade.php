<x-app-layout>
  <x-slot name="pageTitle">مستند جديد</x-slot>

  <x-post-form :action="route('posts.store', ['tmp' => request()->get('tmp')])" method="POST">
    <x-post-form-metadata
      :title="old('title')"
      :no="old('no')"
      :topic="old('topic')"
      :keywords="old('keywords')"
      :suggestedKeywords="$suggestedKeywords"
    />

    <x-post-form-date
      :day="optional(old('hijri'))[0]"
      :month="optional(old('hijri'))[1]"
      :year="optional(old('hijri'))[2] ?? request()->tools()->defaultYear()"
    />

    <x-post-form-tags 
      :tags="$tags"
      :fn="fn ($tag) => old('tag_id') == $tag->id"
    />
  </x-post-form>
</x-app-layout>
