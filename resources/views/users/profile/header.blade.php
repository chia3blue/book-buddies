<div class="row mb-5">
  <div class="col-3 text-center">
    <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none">
      @if ($user->avatar)
          <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
      @else
          <i class="fa-regular fa-face-smile text-secondary b-block text-center icon-lg"></i>
      @endif
    </a>
  </div>
  <div class="col-6 d-flex flex-column align-items-center">
    <div class="row mb-3">
      <div class="col-auto">
        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
          <h2 class="display-6 mb-0">{{ $user->name }}</h2>
        </a>
      </div>
      <div class="col-auto p-2">
        @if (Auth::user()->id === $user->id)
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
        @else
            @if ($user->isFollowed())
              <form action="{{ route('follow.destroy', $user->id) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
              </form>  
            @else
              <form action="{{ route('follow.store', $user->id) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
              </form>
            @endif
        @endif
      </div>
    </div>

    <div class="row mb-2 w-100 text-start">
      {{-- How many books --}}
      <div class="col-auto">
        <a href="{{ route('profile.books', $user->id) }}" class="text-decoration-none text-dark">
          <strong>{{ $user->books->count() }}</strong> {{ $user->books->count() == 1 ? 'book ': 'books' }}
        </a>
      </div>
      {{-- How many followers --}}
      <div class="col-auto">
        <a href="{{ route('profile.followers', $user->id) }}" class="text-decoration-none text-dark">
          <strong>{{ $user->followers->count() }}</strong> {{ $user->followers->count() == 1 ? 'follower':'followers' }}
        </a>
      </div>
      {{-- How many following --}}
      <div class="col-auto">
        <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none text-dark">
          <strong>{{ $user->following->count() }}</strong> following
        </a>
      </div>
    </div>
    {{-- follower & following --}}
    <div class="row mb-3 w-100 text-start">
      {{-- How many booklings --}}
      <div class="col-auto">
        <a href="#" class="text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#show-booklings-modal" title="Booklings I've Raised">
          @if ($user->finishedCreatures->count() === 0)
              <span class="fw-bold">0</span> Booklings Have Grown Up Yet.
          @else
              <span class="fw-bold">{{$user->finishedCreatures->count()}}</span> Bookling{{ $user->finishedCreatures->count() !== 1 ? 's' : '' }} {{ $user->finishedCreatures->count() === 1 ? 'Has' : 'Have' }} Grown Up!
          @endif
        </a>
        {{-- include action modal here --}}
         @include('users.profile.modals.action')
      </div>
    </div>

    <p class="fw-bold w-100 text-start">{{ $user->introduction }}</p>
  </div>

  {{-- My bookling --}}
  <div class="col-3 text-center">
    <p class="mb-2">My Bookling:</p>
    
    @if ($user->current_creature)
      @php
          $stage = $user->current_creature->stage;
          $creature = $user->current_creature->creature;
          $defaultImagePath = asset('images/default/stage_' . $stage . '.png');
          $imagePath = $creature ? $creature->{'image_stage_' . $stage} : $defaultImagePath;
          $creatureName = $creature->name ?? 'Unknown Bookling';
          $stageName = \App\Models\Creature::STAGES[$stage] ?? "Let's add a new book!";
      @endphp

      <p class="fw-bold">{{ $creatureName }}</p>

      @if ($stage === 0)
        {{-- <i class="fa-solid fa-egg text-secondary icon-md"></i> --}}
        <img src="{{ asset('images/stage-0-egg.png') }}" alt="?" class="d-block image-bookling mx-auto">
      @else
        <img
          src="{{ $imagePath }}"
          alt="Stage {{ $stage }} image"
          class="d-block image-bookling mx-auto">
      @endif

      <p class="text-capitalize mt-2">
        Stage <span class="fw-bold">{{ $stage }}</span>: <span class="fw-bold">{{ $stageName }}</span>
      </p>

      @if ($stage === 6)
        <p class="fw-bold text-success">You've Reached the Last Stage!</p>
      @endif
    @else
      <a href="{{ route('book.create') }}" class="btn btn-outline-primary mt-1">
        Let's add a new book and select a bookling!
      </a>
    @endif
  </div>

</div>