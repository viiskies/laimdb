@extends('layouts.app')

@section('content')
<div class="row my-3">
    <div class="col ">
        <h2>{{ $actor->name }}</h2>
        <div class="card-columns">
            @foreach ($actor->images as $image)
                @if($image->featured)
                    <div class="card">
                        <img class="card-img card-img-top" src="{{URL::to('/storage/photos/actors')}}/{{ $image->filename }}">
                        <div class="card-body">
                            <p class="card-text">
                                {{ $actor->birthday }} - {{ $actor->deathday != null ? $actor->deathday : "now" }}
                            </p>
                            @if (Auth::check() && Auth::user()->role == 'admin')
                                <p class="card-text">
                                    <a href="{{ route('actors.edit', ['id' => $actor->id]) }}">Edit</a>
                                </p>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
            @foreach ($actor->images as $image)
                @if(!$image->featured)
                    <div class="card">
                        <img class="card-img img-fluid card-img-top" src="{{URL::to('/storage/photos/actors')}}/{{ $image->filename }}">
                    </div>
                @endif
            @endforeach
            <div class="card p-3">
                <h4>{{ $actor->name }} movies</h4>
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