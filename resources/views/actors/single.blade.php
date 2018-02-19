@extends('layouts.app')

@section('content')
<div class="row my-3">
    <div class="col">
        <h2>{{ $actor->name }}</h2>
        <blockquote class="blockquote">
            <p class="mb-0">{{ $actor->birthday }} - {{ $actor->deathday }}</p>
            <footer class="blockquote-footer">{{ $actor->user->name }}</footer>
        </blockquote>
        <div class="row mb-3">
            <div class="col-9">
                <h4>All {{ $actor->name }} movies</h4>
                <ul>
                    @foreach ($actor->movies as $movie)
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