@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-center mt-3">
            {{ $actors->links() }}
        </div>
        <div class="card-columns actors">
            @foreach($actors as $actor)
            <div class="card">
                @foreach ($actor->images as $image)
                    @if($image->featured)
                        <img src="{{URL::to('/storage/photos/actors')}}/{{ $image->filename }}" class="img-fluid card-img-top">
                    @endif 
                @endforeach
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('actors.show', ['id' => $actor->id]) }}">
                            {{ $actor->name }}
                        </a>
                    </h5>
                    <p class="card-text">
                        {{ $actor->birthday }} - {{ $actor->deathday != null ? $actor->deathday : "now" }}
                    </p>
                </div>
                <ul class="list-group list-group-flush">
                    @if($actor->movies->count() > 0)
                    <li class="list-group-item text-center">
                        <p>
                            <h3>Movies</h3>
                        </p>
                        @foreach ($actor->movies as $movie)
                        <p class="mb-0">
                            <a href="{{ route('movies.show', ['id' => $movie->id]) }}">
                                {{ $movie->name }}
                             </a>
                        </p>
                        @endforeach
                    </li>
                    @endif
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection    