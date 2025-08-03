{{-- Creature Show --}}
<div class="modal fade" id="show-booklings-modal">
  <div class="modal-dialog">
    <div class="modal-content border-primary">
      
      <div class="modal-header border-primary">
        <h5 class="modal-title">
          <i class="fa-solid fa-ghost me-2"></i>Booklings <span class="fw-bold">{{ $user->name }}</span> has Raised
        </h5>
      </div>

      <div class="modal-body">
        <div class="container">
          @if ($user->finishedCreatures->isNotEmpty())
            <div class="d-flex flex-wrap gap-3">
              @foreach ($user->finishedCreatures as $fc)
                @php
                  $stage = 6;
                  $creature = $fc->creature;
                  $imageBase64 = $creature?->{'image_stage_' . $stage};
                  $creatureName = $creature->name ?? 'Unknown Bookling';
                  $imageSrc = $imageBase64
                              ? $imageBase64
                              : asset('images/default/stage_' . $stage . '.png');
                @endphp

                <div class="text-center">
                  <img src="{{ $imageSrc }}"
                      alt="{{ $creatureName }}"
                      class="img-thumbnail rounded-circle image-raised-bookling">
                  <div class="small mt-1 fw-bold">{{ $creatureName }}</div>
                </div>
              @endforeach
            </div>
          @else
            <div class="text-center text-muted py-4">
              <i class="fa-solid fa-seedling fa-2x mb-2"></i><br>
              No fully grown Booklings yet in this collection.
            </div>
          @endif
        </div>
      </div>

      <div class="modal-footer border-0">
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
