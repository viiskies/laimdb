@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card-columns">
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
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection    