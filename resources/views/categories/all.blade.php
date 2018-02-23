@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
        <div class="card-columns">
            
            @foreach($categories as $category)
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-success">
                        <a href="{{ route('categories.show', ['id' => $category->id]) }}">
                            {{ $category->name }}
                        </a>
                    </h3>
                    <p class="card-text">{{ $category->description }}</p>
                    @if($category->movies->count() > 0)
                    <ul class="list-group list-group-flush">
                        <h5>Movies</h5>

                        @foreach($category->movies as $movie)
                        <li class="list-group-item">
                            <a href="{{ route('movies.show', ['id' => $movie->id]) }}">
                                {{ $movie->name }}
                            </a>
                        </li>
                        @endforeach

                    </ul>
                    @endif
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection