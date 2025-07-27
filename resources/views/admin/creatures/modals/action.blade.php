{{-- Creature Show --}}
<div class="modal fade" id="show-creature-{{ $creature->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-primary">
      <div class="modal-header border-primary">
        <h5 class="modal-title">
          {{ $creature->name }}
        </h5>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            @for ($i = 1; $i <= 6; $i++)
              <div class="col-4 text-center mb-3">
                <img src="{{ $creature->{'image_stage_' . $i} }}" alt="{{ $creature->name }} stage{{ $i }}" class="img-fluid">
                <p>Stage {{ $i }}</p>
              </div>
            @endfor
          </div>          
          {{-- <div class="row">
            <div class="col-4 text-center mb-3">
              <img src="{{ $creature->image_stage_1 }}" alt="{{ $creature->name }} stage1" class="image-md">
              <p>Egg</p>
            </div>
          </div> --}}
        </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


{{-- Delete --}}
<div class="modal fade" id="delete-creature-{{ $creature->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header border-danger">
        <h5 class="modal-title text-danger">
          <i class="fa-solid fa-trash-can"></i> Delete Creature
        </h5>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete <span class="fw-bold">{{ $creature->name }}</span></p>
        <p>This action will affect all the books under this creature. books without a creature will change to default creature.</p>      
      </div>
      <div class="modal-footer border-0">
        <form action="{{ route('admin.creatures.destroy', $creature->id) }}" method="post">
          @csrf
          @method('DELETE')

          <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
