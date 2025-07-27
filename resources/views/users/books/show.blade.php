@extends('layouts.app')

@section('title', 'Show Book Post')
    
@section('content')
    <div class="row border shadow">
      <div class="col p-0 border-end text-center">
        @if ($book->cover_photo)
            <img src="{{ $book->cover_photo }}" alt="{{ $book->title }}" class="w-75">
        @else
            <div class="d-flex flex-column justify-content-center align-items-center" style="height: 300px;">
              <i class="fa-regular fa-image text-secondary icon-lg"></i>
              <p class="text-muted">No Cover Photo</p>
            </div>
        @endif
        
      </div>

      <div class="col-6 px-0 bg-white">
        <div class="card border-0">
          <div class="card-header bg-white py-3">
            <div class="row align-items-center">
              <div class="col-auto">
                <a href="{{ route('profile.show', $book->user->id) }}">
                  @if ($book->user->avatar)
                      <img src="{{ $book->user->avatar }}" alt="{{ $book->user->name }}" class="rounded-circle avatar-sm">
                  @else
                      <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                  @endif
                </a>
              </div>

              <div class="col ps-0">
                <a href="{{ route('profile.show', $book->user->id) }}" class="text-decoration-none text-dark">{{ $book->user->name }}</a>
              </div>

                <div class="col-auto">
                  {{-- If you are the owner of the book post, you can edit or delete this post --}}
                  @if (Auth::user()->id === $book->user->id)
                    <div class="dropdown">
                      <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis"></i>
                      </button>
                    
                        <div class="dropdown-menu">
                          <a href="{{ route('book.edit', $book->id) }}" class="dropdown-item">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                          </a>
                          <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-book-{{ $book->id }}">
                            <i class="fa-regular fa-trash-can"></i> Delete
                          </button>
                        </div>
                        {{-- open delete modal --}}
                        @include('users.books.contents.modals.delete')
                    </div>
                  @else
                      {{-- If you are not the owner of the book post, show an unfollow button --}}
                      <div class="dropdown-menu">
                        <a href="#">soon - follow or unfollow</a>
                      </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="card-body w-100 bg-white">
              {{-- [soon] heart button + no. of likes + categories --}}

              {{-- book's impression --}}

              <p class="text-muted xsmall">Posted Date: <span class="text-uppercase">{{ date('M d, Y', strtotime($book->created_at)) }}</span></p>

              <p><span class="text-muted small">Book Title:</span> 
                &nbsp;<span class="fw-bold ">{{ $book->title }}</span>
              </p>

              <p><span class="text-muted small">Author:</span> 
                &nbsp;<span class="fw-bold ">{{ $book->author_name }}</span>
              </p>
              
              <p><span class="text-muted small">My Impression:</span> 
                <br>
                &nbsp;{{ $book->impression }}
              </p>

              {{-- [soon] comments --}}
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection