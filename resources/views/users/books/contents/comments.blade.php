<div class="mt-3">
  {{-- show all comments --}}
  @if ($book->comments->isNotEmpty())
    <ul class="list-group mt-2">
      @foreach ($book->comments->take(3) as $comment)
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

      @if ($book->comments->count() > 3)
        <li class="list-group-item border-0 px-0 pt-0">
          <a href="{{ route('book.show', $book->id) }}" class="text-decoration-none small">View all {{ $book->comments->count() }} comments</a>
        </li>
      @endif
    </ul>
  @endif

  <form action="{{ route('comment.store', $book->id) }}" method="post">
    @csrf

    <div class="input-group">
      <textarea name="comment_body{{ $book->id }}" cols="30" rows="1" class="form-control form-control-sm" placeholder="Add a comment...">{{ old('comment_body' . $book->id ) }}</textarea>
      <button type="submit" class="btn btn-outline-secondary btn-sm" title="Book"><i class="fa-regular fa-paper-plane"></i></button>
    </div>
    @error('comment_body' . $book->id)
        <div class="text-danger small">{{ $message }}</div>
    @enderror
  </form>
</div>