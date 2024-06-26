<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Chirp') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('chirps.update', $chirp )}}" method="post">
                        <!-- @method('PUT') directiva de blade para decir que es un metodo put -->
                        @csrf @method('PUT')
                        <textarea name="message" id="message" cols="30" rows="5"
                        class="mt-4 block w-full rounded-md border-gray-300 bg white shadow-sm transition-colors duration-300 dark:focus:ring-opacity-50 dark:focus:ring-indigo-200 dark:focus:ring dark:focus:border-indigo-300 dark:bg-gray-800 dark_border-gray-600 focus:ring-opacity-50 focus:ring-indigo-200 focus:border-indigo-300"
                        placeholder= "{{ __('What\'s on your mind?') }}"
                        > {{ old('message', $chirp->message) }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        <x-primary-button class="mt-4">{{ __('Chirp')}}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>