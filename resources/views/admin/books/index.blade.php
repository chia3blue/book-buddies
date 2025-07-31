@extends('layouts.app')

@section('title', 'Admin: Books')
    
@section('content')
    <table class="table hover align-middle bg-white border text-secondary text-center">
      <thead class="table-primary text-secondary small">
        <tr>
          <th>ID</th>
          <th>COVER PHOTO</th>
          {{-- <th>CATEGORY</th> --}}
          <th>OWNER</th>
          <th>CREATED AT</th>
          <th>STATUS</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse ($all_books as $book)
            <tr>
              <td class="text-end">{{ $book->id }}</td>
              <td>
                <a href="{{ route('book.show', $book->id) }}" class="text-decoration-none">
                  @if ($book->cover_photo)
                      <img src="{{ $book->cover_photo }}" alt="book post id {{ $book->id }}" class="d-block mx-auto book-img-sm">
                  @else
                      <img src="{{ asset('images/no-image.png') }}" alt="no image" class="d-block mx-auto book-img-sm">
                  @endif
                </a>
              </td>
              {{-- <td>cstegories</td> --}}
              <td>
                <a href="{{ route('profile.show', $book->user->id) }}" class="text-dark text-decoration-none">{{ $book->user->name }}</a>
              </td>
              <td>{{ $book->created_at }}</td>
              <td>
                @if ($book->trashed())
                  <i class="fa-solid fa-circle-minus text-secondary"></i>&nbsp Hidden 
                @else
                  <i class="fa-solid fa-circle text-primary"></i>&nbsp Visible
                @endif
              </td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-sm" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                  </button>
                  @if ($book->trashed())
                    <div class="dropdown-menu">
                      <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-book-{{ $book->id }}">
                        <i class="fa-solid fa-eye"></i> Unhide Book Post {{ $book->id }}
                      </button>
                    </div>  
                  @else
                     <div class="dropdown-menu">
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-book-{{ $book->id }}">
                          <i class="fa-solid fa-eye-slash"></i> Hide Book Post {{ $book->id }}
                        </button>
                      </div> 
                  @endif
                  
                </div>
                @include('admin.books.modals.status')
              </td>
            </tr>
        @empty
            <tr>
              <td colspan="7" class="lead text-muted text-center">No Book Posts Found</td>
            </tr>
        @endforelse
      </tbody>
    </table>
    {{-- pagination --}}
    {{ $all_books->links() }}
@endsection