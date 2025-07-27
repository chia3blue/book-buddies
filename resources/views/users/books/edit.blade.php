@extends('layouts.app')

@section('title', 'Edit Book Post')
    
@section('content')
  <div class="row justify-content-center">
    <div class="col-9">
        <h2>Edit a Book Post</h2>

        <form action="{{ route('book.update', $book->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PATCH')

          <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" name="title" id="title" class="form-control w-100" value="{{ old('title', $book->title) }}" autofocus>
            @error('title')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-3">
            <label for="author-name" class="form-label fw-bold">Author</label>
            <input type="text" name="author_name" id="author-name" class="form-control w-100" value="{{ old('author_name', $book->author_name) }}" autofocus>
            @error('author_name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-3">
            <label for="impression" class="form-label fw-bold">Write your thoughts</label>
            <textarea name="impression" id="impression" rows="10" class="form-control" placeholder="How did you feel after reading? What stayed in your heart?">{{ old('impression', $book->impression) }}</textarea>
            @error('impression')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-4">
            <label for="cover-photo" class="form-label fw-bold">Book Cover Picture</label>
            @if ($book->cover_photo)
               <img src="{{ $book->cover_photo }}" alt="{{ $book->title }}" class="img-thumbnail w-50 d-block mb-2"> 
            @endif

            <input type="file" name="cover_photo" id="cover-photo" class="form-control" aria-describedby="image-info">
            <div class="form-text" id="image-info">
              The acceptable formats are jpeg, jpg, and gif only.<br>
              Max file size is 1048KB.
            </div>
            @error('cover_photo')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary px-5"><i class="fa-regular fa-pen-to-square me-2"></i>Update</button>

        </form>
      </div>
    </div>
@endsection
