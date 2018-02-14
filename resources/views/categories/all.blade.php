@extends('layouts.app')

@section('content')
<div class="row my-3">
    <div class="col-9">
        <h1 class="text-center py-5 display-1">IMDB DB</h1>
        @foreach($categories as $categorie)
        <div class="row mb-3">
            <div class="col-9 offset-md-1 my-3">
                <h2>{{ $categorie->name }}</h2>
                <p>{{ $categorie->description }}</p>
            </div>                
        </div>
        @endforeach
    </div>
    
@endsection
</div>