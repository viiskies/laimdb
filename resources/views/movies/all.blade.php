@extends('layouts.app') 

@section('content')
<div class="row my-3">
    <div class="col">
        <h2>Movies</h2>
        <div class="row mb-3">
            <div class="col-9">
                <ul>
                    @foreach($movies as $movie)
                    <li>
                        <h2>{{ $movie->name }}</h2>
                        <p>Category: {{ $movie->category->name }}</p>
                        <p>Description: {{ $movie->description }}</p>
                        <p>Year: {{ $movie->year }}</p>
                        <p>Rating: {{ $movie->rating }}</p>
                        <p>Created by: {{ $movie->user->name }}</p>
                        @foreach($movie->actors as $actor)
                            <p>{{ $actor->name }}</p>
                        @endforeach
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
</div>