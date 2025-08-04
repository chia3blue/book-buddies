@extends('layouts.app')

@section('title', 'Create Bookling')
    
@section('content')
  <div class="row">
    <div class="col-7">
      <h2 class="mb-3">Add a New Bookling</h2>

      <form action="{{ route('admin.creatures.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
          <label for="name" class="form-label fw-bold">Name</label>
          <input type="text" name="name" id="name" class="form-control w-100" value="{{ old('name') }}" autofocus>
          @error('name')
              <p class="text-danger small">{{ $message }}</p>
          @enderror
        </div>

        <h4>Images</h4>
        <div class="form-text mb-3">
          <i class="fa-solid fa-circle-exclamation text-warning me-2"></i>All Photo, the acceptable formats are jpeg, jpg, and gif only.<br>
          Max file size is 1048KB.
        </div>

        <div class="mb-3">
          <label for="image-stage-1" class="form-label fw-bold">1. Egg</label>
          <input type="file" name="image_stage_1" id="image-stage-1" class="form-control">
          @error('image_stage_1')
              <p class="text-danger small">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-3">
          <label for="image-stage-2" class="form-label fw-bold">2. Hatchling</label>
          <input type="file" name="image_stage_2" id="image-stage-2" class="form-control">
          @error('image_stage_2')
              <p class="text-danger small">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-3">
          <label for="image-stage-3" class="form-label fw-bold">3. Juvenile</label>
          <input type="file" name="image_stage_3" id="image-stage-3" class="form-control">
          @error('image_stage_3')
              <p class="text-danger small">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-3">
          <label for="image-stage-4" class="form-label fw-bold">4. Young</label>
          <input type="file" name="image_stage_4" id="image-stage-4" class="form-control">
          @error('image_stage_4')
              <p class="text-danger small">{{ $message }}</p>
          @enderror
        </div>
        
        <div class="mb-3">
          <label for="image-stage-5" class="form-label fw-bold">5. Adult</label>
          <input type="file" name="image_stage_5" id="image-stage-5" class="form-control">
          @error('image_stage_5')
              <p class="text-danger small">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="image-stage-6" class="form-label fw-bold">6. Legendary</label>
          <input type="file" name="image_stage_6" id="image-stage-6" class="form-control">
          @error('image_stage_6')
              <p class="text-danger small">{{ $message }}</p>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary px-5">Add</button>

      </form>
    </div>
  </div>
@endsection