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
      <div class="dropdown">
        <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
          <i class="fa-solid fa-ellipsis"></i>
        </button>

        {{-- If you are the owner of the book post, you can edit or delete this post --}}
        @if (Auth::user()->id === $book->user->id)
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
        @else
            {{-- If you are not the owner of the book post, show an unfollow button --}}
            <div class="dropdown-menu">
              <a href="#">soon - unfollow</a>
            </div>
        @endif
      </div>
    </div>
  </div>
</div>