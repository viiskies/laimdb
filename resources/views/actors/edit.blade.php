@extends('layouts.app') 

@section('content')
<div class="col-xl-6">
    <form method="post" action="{{ route('actors.update', [ 'actor' => $actor->id ]) }}" enctype="multipart/form-data">
        
        @csrf
        <input type="file" name="photo[]" id="photo" multiple>
        <div class="form-group">
            <div class="form-check">
                @foreach ($actor->images as $image)
                    <img src="{{URL::to('/storage/photos/actors')}}/{{ $image->filename }}" class="img-thumbnail w-25">
                    <input class="form-check-input" name="photo_id[]" type="checkbox" value="{{ $image->filename }}" id="{{ $image->filename }}">
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $actor->name }}">
        </div>
        @if ($errors->get('name'))
            @foreach ($errors->get('name') as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif
        
        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="date" name="birthday" class="form-control" id="birthday" value="{{ $actor->birthday }}"></input>
        </div>
        @if ($errors->get('birthday')) 
            @foreach ($errors->get('birthday') as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif
        
        <div class="form-group">
            <label for="deathday">Date of death</label>
            <input type="date" name="deathday" class="form-control" id="deathday" value="{{ $actor->deathday }}"></input>                                    
        </div>
        @if ($errors->get('deathday')) 
            @foreach ($errors->get('deathday') as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif
        
        <div class="form-group">
            <label for="category">Movies</label> 
            @foreach ($movies as $movie)
            <div class="form-check">
                @if ($actor->movies->contains($movie))
                    <input class="form-check-input" name="movie_id[]" type="checkbox" value="{{ $movie->id }}" id="{{ $movie->name }}" checked>       
                @else
                    <input class="form-check-input" name="movie_id[]" type="checkbox" value="{{ $movie->id }}" id="{{ $movie->name }}">       
                @endif
                <label class="form-check-label" for="{{ $movie->name }}">{{ $movie->name }}</label>
            </div>
            @endforeach
        </div>
        
        <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
</div>
@endsection