@extends('layouts.app')

@section('title', 'Home')
    
@section('content')
    <div class="row gx-5">
        {{-- left side/ all book posts --}}
        <div class="col-8">
            @forelse ($all_books as $book)
                <div class="card mb-4">
                    {{-- title --}}
                    @include('users.books.contents.title')
                    {{-- body --}}
                    @include('users.books.contents.body')
                </div>
            @empty
                {{-- If the site doesn't have any book post yet. --}}
                <div class="text-center">
                    <h2>Share Book Posts</h2>
                    <p class="text-secondary">When you share book posts. they'll appear on your profile.</p>
                    <a href="#" class="text-decoration-none">Share your first book post.</a>
                </div>
            @endforelse
        </div>

        {{-- right side --}}
        <div class="col-4">
            <div class="card" style="width: 18rem;">
            <div class="card-header">
                Coming Soon Features
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark fw-bold" data-bs-toggle="collapse" href="#collapseAnnouncements" role="button" aria-expanded="false" aria-controls="collapseAnnouncements">
                        - <i class="fa-solid fa-bullhorn me-2"></i>Announcements from Your Teacher -
                    </a>
                    <p class="mt-3">Special Event Announcement</p>
                    <p style="text-indent: 2em;">Starting next week, we’ll be holding the “One Book You Recommend” Campaign!
                        Use the app to write about a book you recommend and why you like it.
                        Wonderful reviews may be featured in the school newsletter!</p>
                    <div class="collapse" id="collapseAnnouncements">
                    <div class="card card-body">
                        A feature that allows the admin to add and edit messages, and control which messages are displayed on the home page.
                    </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <a class="text-decoration-none text-dark fw-bold" data-bs-toggle="collapse" href="#collapseTopThree" role="button" aria-expanded="false" aria-controls="collapseTopThree">
                        - <i class="fa-solid fa-ranking-star me-2"></i>Our Buddies' Top 3 Books -
                    </a>
                    <div>
                        <p class="mt-3 mb-0"><i class="fa-solid fa-star text-muted me-2"></i>Andy's Top 3</p>
                        <ul class="list-unstyled mt-1 ps-3">
                            <li><i class="fa-solid fa-trophy text-warning me-2 ms-2"></i>Dog Man</li>
                            <li><i class="fa-solid fa-trophy text-secondary me-2 ms-3"></i>The Secret Garden</li>
                            <li><i class="fa-solid fa-trophy text-danger-emphasis me-2 ms-4"></i>The Little Prince</li>
                        </ul>
                    </div>
                    <div class="mt-4">
                        <p class="mt-3 mb-0"><i class="fa-solid fa-star text-muted me-2"></i>Emma's Top 3</p>
                        <ul class="list-unstyled mt-1 ps-3">
                            <li><i class="fa-solid fa-trophy text-warning me-2 ms-2"></i>Cat Kid</li>
                            <li><i class="fa-solid fa-trophy text-secondary me-2 ms-3"></i>Diary of a Wimpy Kid</li>
                            <li><i class="fa-solid fa-trophy text-danger-emphasis me-2 ms-4"></i>The Little Prince</li>
                        </ul>
                    </div>
                    <div class="collapse" id="collapseTopThree">
                    <div class="card card-body">
                        Users can select their Top 3 books from their own book posts.<br><br>
                        Administrators can manage whether to display each user’s Top 3 books on the home screen.
                    </div>
                    </div>
                </li>
                <li class="list-group-item">etc.</li>
            </ul>
            </div>
            {{-- [soon] PROFILE? OVERVIEW --}}

            {{-- [soon] Suggestions or ranking --}}

        </div>
    </div>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection
