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
                        <h4>{{ $actor->name }}</h4>
                        <p>{{ $actor->birthday }} - {{ $actor->deathday }}</p>
                    </li>
                    @endforeach
                </ul>
            </div>                
        </div>
    </div>
@endsection

</div>