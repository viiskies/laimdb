@extends('layouts.app') 

@section('content')
<div class="row">
    <div class="col">
        <div class="card-columns">
            @for($i=0; $i<5; $i++)
            @foreach($movies as $movie)
            <div class="card">
                @foreach ($movie->images as $image)
                    @if($image->featured)
                        <img src="{{URL::to('/storage/photos/movies')}}/{{ $image->filename }}" class="img-fluid card-img-top">
                    @endif
                @endforeach
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('movies.show', ['id' => $movie->id]) }}">
                            {{ $movie->name }} ({{ $movie->year }})
                        </a>
                    </h5>
                    <p class="card-text">
                        <em>{{ $movie->category->name }}</em> · {{ $movie->description }}
                    </p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-center align-items-center">                 
                        <a href="{{ route('movies.upvote', ['id' => $movie->id]) }}">
                            <span class="badge badge-pill badge-success">UP</span>
                        </a>
                        <h3 class="mx-2">{{$movie->rating}}</h3>
                        <a href="{{ route('movies.downvote', ['id' => $movie->id]) }}">
                            <span class="badge badge-pill badge-primary">DOWN</span>
                        </a>
                    </li>
                    @if($movie->actors->count() > 0)
                    <li class="list-group-item text-center">
                        <p><h3>Actors</h3></p>
                        @foreach ($movie->actors as $actor)
                        <p class="mb-0">
                            <a href="{{ route('actors.show', ['id' => $actor->id]) }}">
                                {{ $actor->name }}
                            </a>
                        </p>
                        @endforeach
                    </li>   
                    @endif
                </ul>
            </div>
            @endforeach
            @endfor
        </div>
    </div>
@endsection
</div>