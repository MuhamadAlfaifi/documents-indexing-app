<x-app-layout>
  <x-slot name="pageTitle">إدارة المستخدمين</x-slot>
  <ul>
    @foreach ($users as $user)
      <li>{{ $user->name }} - {{ $user->password }} - {{ $user->created_at }}</li>
    @endforeach
  </ul>
</x-app-layout>