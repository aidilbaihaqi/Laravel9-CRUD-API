<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card border-0 shadow-sm rounded p-3">
                    <img src="{{ asset('storage/articles/'.basename($data->image)) }}" width="200" class="img-thumbnail" alt="ini gambar">
                    <br>
                    <h4 class="">{{ $data->title }}</h4>
                    <p>{!! $data->content !!}</p>
                    <a href="{{ route('articles.index') }}" class="btn btn-danger">KEMBALI</a>
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>
