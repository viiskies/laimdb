@extends('layouts.app')

@section('content')
<div class="row my-3">
    <div class="col">
        <h2>Actors</h2>
        <div class="row mb-3">
            <div class="col-9">
                <ul>
                    @foreach($actors as $actor)
                    <li>
                        <h4>
                            <a href="{{ route('actors.show', ['id' => $actor->id]) }}">
                                {{ $actor->name }}
                            </a>
                        </h4>
                        <p>{{ $actor->birthday }} - {{ $actor->deathday }}</p>
                        Movies:
                        <ul>
                            @foreach($actor->movies as $movie)
                            <li>{{ $movie->name }}</li> 
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