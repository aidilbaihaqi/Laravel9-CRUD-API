<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                          <div class="d-flex justify-content-between mb-3">
                            <h4 class="fw-semibold">Data Category</h4>
                            <div>
                              <a href="{{ route('categories.create') }}" class="btn btn-md btn-success me-2">Tambah data</a>
                            </div>
                          </div>
            
            
                          @if(Session::has('success'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                          @endif

                          @if(Session::has('errors'))
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Failed!</strong> {{ Session::get('errors') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                          @endif
                          
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">User ID</th>
                                <th scope="col" style="width: 15%;">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($data as $d)
                              <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->user_id }}</td>
                                <td>
                                  <form action="{{ route('categories.destroy', $d->id) }}" method="post">
                                    <a href="{{ route('categories.show', $d->id) }}" class="btn btn-md btn-secondary">
                                      <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', $d->id) }}" class="btn btn-md btn-primary">
                                      <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
            
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-md btn-danger">
                                      <i class="fa-solid fa-trash"></i>
                                    </button>
                                  </form>
                                </td>
                              </tr>
                              @empty
                              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Not Found!</strong> No data in database.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                              @endforelse
                            </tbody>
                          </table>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
