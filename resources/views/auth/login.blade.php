<x-guest-layout>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="{{ asset('logo.png') }}" alt="الأرشيف الإلكتروني" />
        
        <x-validation-errors class="my-4 text-center" />

        @if (session('status'))
          <div class="my-4 font-medium text-sm text-green-600 text-center">
            {{ session('status') }}
          </div>
        @endif
      </div>
      <form method="POST" action="{{ route('login') }}" autocomplete="off" class="mt-8 space-y-6">
        @csrf()
        <input type="hidden" name="remember-me" value="true">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="username" class="sr-only">{{ __('Username') }}</label>
            <input id="username" name="username" type="username" value="{{ old('username') ?: (env('MASTER_USERNAME') === 'demo' ? 'DEMO' : '') }}" required autofocus placeholder="{{ __('Username') }}"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          </div>
          <div>
            <label for="password" class="sr-only">{{ __('Password') }}</label>
            <input id="password" name="password" type="password" value="{{ old('password') ?: (env('MASTER_USERNAME') === 'demo' ? 'demo$password' : '') }}" required placeholder="{{ __('Password') }}"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          </div>
        </div>

        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <span class="absolute right-0 inset-y-0 flex items-center pr-3">
              <x-heroicons.lock-closed class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" />
            </span>
            {{ __('Log in') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</x-guest-layout>
