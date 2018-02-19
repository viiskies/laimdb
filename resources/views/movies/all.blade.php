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
                        <h2>
                            <a href="{{ route('movies.show', ['id' => $movie->id]) }}">
                            {{ $movie->name }}
                            </a>
                        </h2>
                        <p>Category: 
                            <a href="{{ route('categories.show', ['id' => $movie->category->id]) }}">
                            {{ $movie->category->name }}
                            </a>
                        </p>
                        <p>Description: {{ $movie->description }}</p>
                        <p>Year: {{ $movie->year }}</p>
                        <p>Rating: {{ $movie->rating }}</p>
                        Actors:
                        <ul>
                            @foreach($movie->actors as $actor)
                                <li>
                                    <a href="{{ route('actors.show', ['id' => $actor->id]) }}">
                                    {{ $actor->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
</div>