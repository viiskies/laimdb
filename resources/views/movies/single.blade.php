@extends('layouts.app')

@section('content')
<div class="row my-3">
    <div class="col">
        <h2>{{ $movie->name }} ({{ $movie->year }})</h2>
        <h4>{{ $movie->rating }}</h4>

        @foreach ($movie->images as $image)
            <img src="{{URL::to('/storage/photos/')}}/{{ $image->filename }}">
        @endforeach

        <blockquote class="blockquote">
            <p class="mb-0">{{ $movie->description }}</p>
            <footer class="blockquote-footer">{{ $movie->user->name }}</footer>
        </blockquote>
        <div class="row mb-3">
            <div class="col-9">
                <h4>All {{ $movie->name }} actors</h4>
                <ul>
                    @foreach ($movie->actors as $actor)
                    <li><a href="{{ route('actors.show', ['id' => $actor->id]) }}">
                        {{ $actor->name }}
                    </a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

</div>