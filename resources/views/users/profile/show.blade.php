@extends('layouts.app')

@section('title', 'Profile: ' . $user->name)
    
@section('content')
  @include('users.profile.header')

  {{-- Show all books here --}}
  {{-- <div style="margin-top: 100px;">
    @if ($user->books->isNotEmpty())
        <div class="row">
          @foreach ($user->books as $book)
              <div class="col-lg-4 col-mb-6 mb-4">
                <a href="{{ route('book.show', $book->id) }}">
                  <img src="{{ $book->cover_photo }}" alt="{{ $book->title }}" class="grid-img">
                </a>
              </div>
          @endforeach
        </div>
    @else
        <h3 class="text-muted text-center">No Posts Yet</h3>
    @endif
  </div> --}}
  <hr style="border-style: dotted;">
  
  <div class="container py-4">
    <h2 id="bookshelf" class="text-center mb-5">{{ $user->name }}'s Bookshelf</h2>

    @if ($user->books->isNotEmpty())
        @foreach ($user->books->chunk(3) as $bookRow)
            <div class="d-flex justify-content-center gap-5 book-row">
                @foreach ($bookRow as $book)
                    <a href="{{ route('book.show', $book->id) }}" class="text-decoration-none">
                      @if ($book->cover_photo)
                          <img src="{{ $book->cover_photo }}" alt="{{ $book->title }}" class="img-thumbnail book-img">
                      @else
                          {{-- [later] public > images にno imageの画像入れるか、iタグ調整 --}}
                          {{-- <i class="fa-regular fa-image img-thumbnail book-img icon-sm" style="width: 200px">
                             No Image
                            <br>
                            <br>
                            <span>{{ $book->title }}</span>
                          </i> --}}
                          <div class="img-thumbnail book-img  d-flex flex-column justify-content-center align-items-center" style="width: 200px">
                            <p><span class="fw-bold h3 text-secondary">{{ $book->title }}</span><br><span class="text-muted small">by {{ $book->author_name }}</span></p>
                          </div>
                      @endif
                        
                    </a>
                @endforeach
            </div>
            <div class="shelf mb-5"></div>
        @endforeach
    @else
        <h3 class="text-muted text-center">No Posts Yet</h3>
    @endif
  </div>
@endsection