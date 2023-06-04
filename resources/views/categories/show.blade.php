<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card border-0 shadow-sm rounded p-3">
                    <h2>Name : {{ $data->name }}</h2>
                    <h2>User ID : {{ $data->user_id }}</h2>
                    <a href="{{ route('categories.index') }}" class="btn btn-danger">KEMBALI</a>
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>
