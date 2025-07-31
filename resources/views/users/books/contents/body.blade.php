{{-- Clickable image --}}
<div class="container px-0 pt-3 pb-0 text-center">
  <p><span class="fw-bold fs-5">{{ $book->title }}</span>
    <br>
    <span class="text-muted small">&nbsp;by {{ $book->author_name }}</span>
  </p>
  
  <a href="{{ route('book.show', $book->id) }}" class="text-decoration-none">
    @if ($book->cover_photo)
      <img src="{{ $book->cover_photo }}" alt="{{ $book->title }}" class="img-fluid w-50">
    @else
      <img src="{{ asset('images/no-image.png') }}" alt="No image" class="img-fluid w-50">
    @endif
  </a>
</div>
<div class="card-body">
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
      {{-- [soon] categories --}}
    </div>
   </div>
    
   {{-- impression & posted date --}}
    <p style="text-indent: 2em;">{{ $book->impression }}</p>

    <p class="text-muted xsmall">Posted Date: <span class="text-uppercase">{{ date('M d, Y', strtotime($book->created_at)) }}</span></p>

    {{-- comments --}}
    @include('users.books.contents.comments')
</div>