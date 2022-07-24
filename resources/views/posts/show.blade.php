<x-app-layout>
  <x-slot:pageTitle>عرض ملف</x-slot:pageTitle>

  <div class="bg-white">
    <div class="text-center py-16 px-4 sm:px-6 lg:px-8">
      <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">{{ $post->title }}</h1>
    </div>

    <div class="relative z-10 bg-white border-b border-gray-200 pb-4">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex space-x-reverse space-x-2">
          <strong>رقم الملف: </strong>
          <p>{{ $post->id }}</p>
        </div>
        <div class="flex space-x-reverse space-x-2">
          <strong>العنوان: </strong>
          <p>{{ $post->title }}</p>
        </div>
        <div class="flex space-x-reverse space-x-2">
          <strong>كلمات مفتاحية: </strong>
          <p>{{ $post->keywords }}</p>
        </div>
        <div class="flex space-x-reverse space-x-2">
          <strong>التصنيف: </strong>
          @foreach ($post->tags as $tag)  
            <p>{{ $tag->name }}</p>
          @endforeach
        </div>
        <div class="flex space-x-reverse space-x-2">
          <strong>أضيف من قبل: </strong>
          <p>{{ $post->user->name }}</p>
        </div>
        <div class="flex space-x-reverse space-x-2">
          <strong>تاريخ الإضافة: </strong>
          <p>{{ $post->created_at }}</p>
        </div>
      </div>
    </div>

    <div class="relative z-10 bg-white pb-4">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1>listing</h1>
        @foreach ($post->getMedia('default') as $media)
          <a href="{{ $media->getUrl() }}" download="{{ join(' - ', [$post->title, $post->created_at])}}">تحميل الملف</a>
          <img src="{{ $media->getUrl('thumbnail') }}" onerror="event.target.src='https://via.placeholder.com/100x100'" class="aspect-square" alt="" />
          <br />
          <img src="{{ $media->getUrl() }}" onerror="event.target.src='https://via.placeholder.com/100x100'" class="aspect-square" alt="" />
          <br />
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout>