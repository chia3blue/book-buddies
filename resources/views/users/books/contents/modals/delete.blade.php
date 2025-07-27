<div class="modal fade" id="delete-book-{{ $book->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header border-danger">
        <h5 class="modal-title text-danger">
          <i class="fa-solid fa-circle-exclamation"></i> Delete Book
        </h5>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this book?</p>
        <div class="mt-3">
          <img src="{{ $book->cover_photo }}" alt="{{ $book->title }}" class="image-lg">
        </div>
      </div>
      <div class="modal-footer border-0">
        <form action="{{ route('book.destroy', $book->id) }}" method="post">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>