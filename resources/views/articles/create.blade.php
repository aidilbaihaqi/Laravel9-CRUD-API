<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="my-3">
                    <h3 class="text-center">Tambah Data Article</h3>
                  </div>
                  <div class="card-body p-2">
                    <form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
      
                      <div class="form-group mb-3">
                        <label for="title">Title : </label>
                        <input type="text" class="form-control" name="title" id="title">
                      </div>
                      <div class="form-group mb-3">
                        <label for="content">Content : </label>
                        <textarea type="text" class="form-control" name="content" id="content"></textarea>
                      </div>
                      <div class="form-group mb-3">
                        <label for="image">Image : </label>
                        <input type="file" class="form-control" name="image" id="image">
                      </div>
                      <div class="form-group mb-3">
                        <label for="user_id">User ID : </label>
                        <input type="number" class="form-control" name="user_id" id="user_id">
                      </div>
                      <div class="form-group mb-3">
                        <label for="category_id">Category ID : </label>
                        <input type="number" class="form-control" name="category_id" id="category_id">
                      </div>
                      
                      <div class="d-flex justify-content-between">
                        <div>
                          <button type="submit" class="btn btn-primary">SUBMIT</button>
                          <button type="reset" class="btn btn-secondary">RESET</button>
                        </div>
                        <a href="{{ route('articles.index') }}" class="btn btn-danger">KEMBALI</a>
                      </div>
                      
                    </form>
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>
