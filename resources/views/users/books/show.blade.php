@extends('layouts.app')

@section('title', 'Show Book Post')
    
@section('content')
  <style>
    .col-6{
      overflow-y: scroll;
    }

    .card-body{
      position: absolute;
      top: 65px;
    }
  </style>

    <div class="row border shadow">
      <div class="col p-0 border-end text-center">
        @if ($book->cover_photo)
            <img src="{{ $book->cover_photo }}" alt="{{ $book->title }}" class="w-75">
        @else
            <img src="{{ asset('images/no-image.png') }}" alt="No image" class="w-75">
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
                      {{-- If you are not the owner of the book post, show a follow/unfollow button --}}
                      @if ($book->user->isFollowed())
                        <form action="{{ route('follow.destroy', $book->user->id) }}" method="post" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="border-0 bg-transparent p-0 text-secondary">Following</button>
                        </form>  
                      @else
                        <form action="{{ route('follow.store', $book->user->id) }}" method="post" class="d-inline">
                          @csrf
                          <button type="submit" class="border-0 bg-transparent p-0 text-primary">Follow</button>
                        </form>
                      @endif
                  @endif
                </div>
              </div>
            </div>
            <div class="card-body w-100 bg-white">
              {{-- heart button + no. of likes + categories --}}
              <div class="row align-items-center">
                <div class="col-auto">
                  @if ($book->isLiked())
                    <form action="{{ route('like.destroy', $book->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm p-0"><i class="fa-solid fa-heart text-danger"></i></button>
                    </form> 
                  @else
                    <form action="{{ route('like.store', $book->id) }}" method="post">
                      @csrf

                      <button type="submit" class="btn btn-sm shadow-none p-0"><i class="fa-regular fa-heart"></i></button>
                    </form>
                  @endif
                </div>
                <div class="col-auto px-0">
                  <span>{{ $book->likes->count() }}</span>
                </div>
                <div class="col text-end">
                  {{-- [soon] book categories --}}
                </div>
              </div>

              {{-- book's impression & posted date & title & author --}}
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

              <p class="text-muted xsmall">Posted Date: <span class="text-uppercase">{{ date('M d, Y', strtotime($book->created_at)) }}</span></p>

              {{-- comments --}}
              <div class="mt-4">
                <form action="{{ route('comment.store', $book->id) }}" method="post">
                  @csrf

                  <div class="input-group">
                    <textarea name="comment_body{{ $book->id }}" rows="1" class="form-control form-control-sm" placeholder="Add a comment...">{{ old('comment_body' . $book->id ) }}</textarea>
                    <button type="submit" class="btn btn-outline-secondary btn-sm" title="Book"><i class="fa-regular fa-paper-plane"></i></button>
                  </div>
                  @error('comment_body' . $book->id)
                      <div class="text-danger small">{{ $message }}</div>
                  @enderror
                </form>

                {{-- Show all comments --}}
                @if ($book->comments->isNotEmpty())
                  <ul class="list-group mt-2">
                    @foreach ($book->comments as $comment)
                      <li class="list-group-item border-0 p-0 mb-2">
                        <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
                        &nbsp;
                        <p class="d-inline fw-light">{{ $comment->body }}</p>

                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                          @csrf
                          @method('DELETE')

                          <span class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($comment->created_at)) }}</span>

                          {{-- If the auth user is the owner of the comment, show a delete button --}}
                          @if (Auth::user()->id === $comment->user->id)
                            <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                          @endif
                        </form>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection