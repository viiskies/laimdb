@extends('layouts.app') 

@section('content')
<div class="col-xl-6">
    <form method="post" action="{{ route('actors.update', [ 'actor' => $actor->id ]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('shared.errors')

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
            <div class="form-radio">
                @foreach ($actor->images as $image)
                    <img src="{{URL::to('/storage/photos/actors')}}/{{ $image->filename }}" class="img-thumbnail w-25">
                    <input class="form-radio-input" name="featured" type="radio" value="{{ $image->id }}" id="{{ $image->filename }}">        
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name', $actor->name) }}">
        </div>

        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="date" name="birthday" class="form-control" id="birthday" value="{{ old('birthday', $actor->birthday) }}">
        </div>
        
        <div class="form-group">
            <label for="deathday">Date of death</label>
            <input type="date" name="deathday" class="form-control" id="deathday" value="{{ old('deathday', $actor->deathday) }}">
        </div>

        <div class="form-group">
            <label for="movies">Movies</label><br>
            <select class="js-example-basic-multiple" name="movie_id[]" multiple="multiple" id="movies">
                @foreach ($movies as $movie)
                    <option value="{{ $movie->id }}"
                            {{ (collect(old('movie_id'))->contains($movie->id)) || $actor->movies->contains('id', $movie->id) ? 'selected':'' }}>{{ $movie->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
</div>
@endsection