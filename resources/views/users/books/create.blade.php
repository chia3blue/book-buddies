@extends('layouts.app')

@section('title', 'Create Book Post')
    
@section('content')
  <div class="row justify-content-center">
    <div class="col-9">
        <h2>Add a New Book</h2>

        <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" name="title" id="title" class="form-control w-100" value="{{ old('title') }}" autofocus>
            @error('title')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-3">
            <label for="author-name" class="form-label fw-bold">Author</label>
            <input type="text" name="author_name" id="author-name" class="form-control w-100" value="{{ old('author_name') }}" autofocus>
            @error('author_name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-3">
            <label for="impression" class="form-label fw-bold">Write your thoughts</label>
            <textarea name="impression" id="impression" rows="10" class="form-control" placeholder="How did you feel after reading? What stayed in your heart?">{{ old('impression') }}</textarea>
            @error('impression')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-4">
            <label for="cover-photo" class="form-label fw-bold">Book Cover Picture</label>
            <input type="file" name="cover_photo" id="cover-photo" class="form-control" aria-describedby="image-info">
            <div class="form-text" id="image-info">
              The acceptable formats are jpeg, jpg, and gif only.<br>
              Max file size is 1048KB.
            </div>
            @error('cover_photo')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
          </div>

          {{-- Choose a bookling --}}
          @if (!$current)
            <div class="mb-4">
              <label for="creature-id" class="form-label d-block fw-bold">
                <i class="fa-solid fa-ghost me-2"></i>Choose a bookling
              </label>
              <select name="creature_id" id="creature-id" class="form-select">
                <option value="">Default (Unknown Bookling)</option>
                @if ($all_creatures)
                  @foreach ($all_creatures as $creature)
                    <option value="{{ $creature->id }}">{{ $creature->name }}</option>
                  @endforeach  
                @endif
              </select>
            </div>
          @endif

          <button type="submit" class="btn btn-primary px-5"><i class="fa-solid fa-plus me-2"></i>Add</button>

        </form>
      </div>
    </div>
@endsection
