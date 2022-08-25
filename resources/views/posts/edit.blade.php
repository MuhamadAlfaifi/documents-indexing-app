<x-app-layout>
  <x-slot name="pageTitle">تعديل ملف</x-slot>

  <x-post-form :action="route('posts.update', ['post' => $post->id])" method="PUT">
    <x-post-form-metadata
      :title="$post->title"
      :no="$post->no"
      :topic="$post->topic"
      :keywords="$post->keywords"
    />

    <x-post-form-date
      :day="$post->hijri_day"
      :month="$post->hijri_month"
      :year="$post->hijri_year"
    />

    <x-post-form-tags 
      :tags="$tags"
      :fn="fn ($tag) => $post->tags->contains(fn ($x) => $x->id === $tag->id)"
    />
  </x-post-form>
</x-app-layout>
