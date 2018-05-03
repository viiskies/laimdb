@extends('layouts.app')

@section('content')
    <div class="row my-3">
        <div class="col ">
            <h2>{{ $movie->name }}</h2>
            <div class="card-columns">
                @foreach ($movie->images as $image)
                    @if($image->featured)
                        <div class="card">
                            <img class="card-img card-img-top" src="{{ URL::to('/storage/photos/movies') }}/{{ $image->filename }}">
                            <div class="card-body">
                                <p class="card-text">{{ $movie->year }}</p>
                                @if (Auth::check() && Auth::user()->role == 'admin')
                                    <p class="card-text">
                                        <a href="{{ route('movies.edit', ['id' => $movie->id]) }}">Edit</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
                @foreach ($movie->images as $image)
                    @if(!$image->featured)
                        <div class="card">
                            <img class="card-img img-fluid card-img-top" src="{{ URL::to('/storage/photos/movies') }}/{{ $image->filename }}">
                        </div>
                    @endif
                @endforeach
                <div class="card p-3">
                    <h4>Movie actors</h4>
                    <ul>
                        @foreach ($movie->actors as $actor)
                            <li>
                                <a href="{{ route('actors.show', ['id' => $actor->id]) }}">
                                    {{ $actor->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection