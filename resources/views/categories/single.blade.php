@extends('layouts.app')

@section('content')
<div class="row my-3">
    <div class="col">
        <h2>{{ $category->name }}</h2>
        <blockquote class="blockquote">
            <p class="mb-0">{{ $category->description }}</p>
            <footer class="blockquote-footer">{{ $category->user->name }}</footer>
        </blockquote>
        <div class="row mb-3">
            <div class="col-9">
                <h4>All {{ $category->name }} movies</h4>
                <ul>
                    @foreach ($category->movies as $movie)
                    <li>
                        <a href="{{ route('movies.show', ['id' => $movie->id]) }}">
                        {{ $movie->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

</div>