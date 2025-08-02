@extends('layouts.app')

@section('title', 'Books')
    
@section('content')
    @include('users.profile.header')

    <div style="margin-top: 100px">
      <div class="row justify-content-center">
        <div class="col-10">
          <h3 class="text-muted text-center mb-3">Books</h3>
          <table class="table text-center table-striped">
            <thead class="text-start small">
              <tr>
                <th>BOOK TITLE</th>
                <th>AUTHOR</th>
                {{-- <th>CATEGORY</th> --}}
                <th>POSTED DATE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @forelse ($books as $book)
                  <td class="text-start text-truncate" style="max-width: 300px;">
                    <a href="{{ route('book.show', $book->id) }}" class="text-decoration-none text-dark fw-bold">
                      <i class="fa-solid fa-link me-2 text-info"></i>{{ $book->title }}
                    </a>
                  </td>
                  <td class="text-start text-truncate" style="max-width: 200px;">{{ $book->author_name }}</td>
                  {{-- <td>categories</td> --}}
                  <td class="text-start"><span class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($book->created_at)) }}</span></td>
              </tr>
            @empty
              <h3 class="text-secondary text-center">No Books Found</h3>
            @endforelse
          </tbody>
        </table>  
        {{-- pagination --}}
        <div class="d-flex justify-content-center">
        {{ $books->links() }}
        </div>
      </div>
    </div>

@endsection