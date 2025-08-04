@extends('layouts.app')

@section('title', 'Admin: Creatures')
    
@section('content')

  <div class="mb-3"><a href="{{ route('admin.creatures.create') }}">Add a New Bookling</a></div>

  <div class="row">
    <div class="col-7">
      <table class="table table-hover align-middle bg-white border text-center text-secondary">
        <thead class="small table-warning text-secondary">
          <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>COUNT</th>
            <th>CREATED AT</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
           @forelse($all_creatures as $creature)
              <tr>
                <td>{{ $creature->id }}</td>
                <td><a href="#" data-bs-toggle="modal" data-bs-target="#show-creature-{{ $creature->id }}">{{ $creature->name }}</a></td>
                <td>{{ $creature->userCreatures->count() }}</td>
                <td>{{ $creature->created_at }}</td>
                <td>
                  {{-- Edit Button --}}
                  {{-- link to edit creature page --}}
                  <a href="{{ route('admin.creatures.edit', $creature->id) }}" class="btn btn-outline-warning btn-sm me-2">
                    <i class="fa-solid fa-pen"></i>
                  </a>

                  {{-- Delete Button --}}
                  <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-creature-{{ $creature->id }}" title="Delete">
                  <i class="fa-solid fa-trash-can"></i>
                  </button>
                </td>
              </tr>
               {{-- include action modal here --}}
               @include('admin.creatures.modals.action')
               @empty
                <tr>
                  <td colspan="5" class="lead text-muted text-center">No booklings found yet.</td>
                </tr>
          @endforelse
          {{-- <tr>
            <td></td>
            <td class="text-dark">
              Default
              <p class="xsmall mb-0 text-muted">Hidden users are not included.</p>
            </td>
            <td>{{ $default_count }}</td>
            <td></td>
            <td></td>
          </tr> --}}
        </tbody>
      </table>
    </div>
  </div>
    <div class="d-flex justify-content-center">
      {{ $all_creatures->links() }}
    </div>
@endsection