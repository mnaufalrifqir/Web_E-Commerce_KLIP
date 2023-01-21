<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
                <div class="h-10 mt-4">
                    <a
                        href="{{ route('index') }}"class="bg-green-500 rounded-full px-4 py-2 mx-4 my-4 text-xs font-semibold text-white">
                        <- Menuju Halaman Utama ->
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
