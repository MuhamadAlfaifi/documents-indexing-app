<x-app-layout>
  <x-slot name="pageTitle">إدارة المستخدمين</x-slot>
  <div class="p-8">
    <div class="mt-10 sm:mt-0">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Add Team Member') }}</h3>
            <p class="mt-1 text-sm text-gray-600">
              {{ __('Add a new team member to your team, allowing them to collaborate with you.') }}</p>
            <x-validation-errors class="mt-6" />
          </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
          <form action="{{ route('users.store') }}" method="POST">
            @csrf()
            <div class="shadow overflow-hidden sm:rounded-md">
              <div class="px-4 py-5 bg-gray-100 sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6">
                    <label for="username" class="block text-sm font-medium text-gray-700">{{ __('Username') }}</label>
                    <input type="text" name="username" id="username" autocomplete="username" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>
                  <div class="col-span-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                    <input type="text" name="password" id="password" autocomplete="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>
                  <div class="col-span-6">
                    <label for="permissions" class="block text-sm font-medium text-gray-700">{{ __('Permissions') }}</label>
                    <div x-data="{ selectedRole: '' }" class="relative z-0 mt-1 border bg-white border-gray-200 rounded-lg cursor-pointer" x-cloak>
                      @foreach ($roles as $index => $role)
                        <button type="button" x-on:click="selectedRole = '{{ $role->name }}'"
                          class="relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 {{ $index > 0 ? 'border-t border-gray-200 rounded-t-none' : '' }} {{ !$loop->last ? 'rounded-b-none' : '' }}">
                          <div :class="selectedRole !== '{{ $role->name }}' && 'opacity-50'">
                            <!-- Role Name -->
                            <div class="flex items-center">
                              <label class="text-sm text-gray-600" :class="selectedRole === '{{ $role->name }}' && 'font-semibold'">
                                {{ __($role->name) }}
                                <input type="radio" name="role" value="{{ $role->name }}" x-model="selectedRole" class="sr-only" />
                              </label>

                              <x-heroicons.check-circle class="mr-2 h-5 w-5 text-green-400"
                                x-show="selectedRole === '{{ $role->name }}'" />
                            </div>

                            <!-- Role Description -->
                            <div class="mt-2 text-xs text-gray-600 text-right">
                              {{ __($role->description) }}
                            </div>
                          </div>
                        </button>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              <div class="px-4 py-3 bg-gray-200 text-left sm:px-6">
                <button type="submit"
                  class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('Create') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="md:grid md:grid-cols-3 mt-10 md:gap-6 outline-2 outline-red-500 outline-offset-2" style="outline-style: auto">
        <div class="md:col-span-1">
          <div class="p-3">
            <h3 class="text-lg font-medium leading-6 text-red-500">{{ __('Disable Team Member') }}</h3>
            <p class="mt-1 text-sm text-gray-600">{{ __('All of the people that are part of this team.') }}</p>
          </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
          <ul role="list" class="divide-y divide-gray-200">
            @foreach ($users->sortBy('created_at') as $user)
              <li class="py-4 flex justify-between">
                <div class="flex">
                  <x-heroicons.user-circle class="h-10 w-10 rounded-full" />
                  <div class="mr-3">
                    <p class="text-sm font-medium text-gray-900">{{ $user->username }}</p>
                    <p class="text-sm text-gray-500">{{ $user->roles()->get()->map(fn ($x) => __($x->name))->join(', ') }}</p>
                  </div>
                </div>
                @if (auth()->user()->id !== $user->id)
                  @if ($user->enabled == true)
                  <form action="{{ route('users.update', ['user' => $user->id, 'enabled' => false]) }}" method="POST" class="ml-6">
                    @csrf()
                    @method('put')
                    <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">{{ __('Disable') }}</button>
                  </form>
                  @else
                  <form action="{{ route('users.update', ['user' => $user->id, 'enabled' => true]) }}" method="POST" class="ml-6">
                    @csrf()
                    @method('put')
                    <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('Enable') }}</button>
                  </form>
                  @endif
                @endif
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
