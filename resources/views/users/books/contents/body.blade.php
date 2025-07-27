{{-- Clickable image --}}
<div class="container px-0 pt-3 pb-0 text-center">
  <p><span class="fw-bold fs-5">{{ $book->title }}</span>
    <br>
    <span class="text-muted small">&nbsp;by {{ $book->author_name }}</span>
  </p>
  
  <a href="{{ route('book.show', $book->id) }}">
    @if ($book->cover_photo)
      <img src="{{ $book->cover_photo }}" alt="{{ $book->title }}" class="w-50">
    @else
      <i class="fa-regular fa-image fa-10x text-secondary d-block text-center"></i>
    @endif
  </a>
</div>
<div class="card-body">
   {{-- [soon] heart button + no. of likes + categories --}}
   {{-- <a href="#" class="text-decoration-none text-dark fw-bold">{{ $book->user->name }}</a> --}}
   {{-- &nbsp; --}}
    
    <p style="text-indent: 2em;">{{ $book->impression }}</p>

    <p class="text-muted xsmall">Posted Date: <span class="text-uppercase">{{ date('M d, Y', strtotime($book->created_at)) }}</span></p>

    {{-- [soon] Include comments here --}}
</div>