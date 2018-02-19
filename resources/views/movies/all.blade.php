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
                        <p>{{ $movie->name }}</p>
                        <p>Category: {{ $movie->category->name }}</p>
                        <p>Description: {{ $movie->description }}</p>
                        <p>Year: {{ $movie->year }}</p>
                        <p>Rating: {{ $movie->rating }}</p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
</div>