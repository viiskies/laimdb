@extends('layouts.app') 

@section('content')
<div class="row my-3">
    <div class="col">
        <div class="card-columns">
            @foreach($movies as $movie)
                <div class="card">
                    @foreach ($movie->images as $image)
                        <img src="{{URL::to('/storage/photos/movies')}}/{{ $image->filename }}" class="img-fluid card-img-top">
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
                            <span class="badge badge-pill badge-success">UP</span>
                            <h3 class="mx-2">{{$movie->rating}}</h3>
                            <span class="badge badge-pill badge-primary">DOWN</span>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection
</div>