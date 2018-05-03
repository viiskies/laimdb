@extends('layouts.app') 

@section('content')
<div class="col-xl-6">
    <form method="post" action="{{ route('actors.store') }}" enctype="multipart/form-data">
        @csrf
        @include('shared.errors')

        <input type="file" name="photo[]" id="photo" multiple>

        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="birthday">Birthday *</label>
            <input type="date" name="birthday" class="form-control" id="birthday" value="{{ old('birthday') }}">
        </div>

        <div class="form-group">
            <label for="deathday">Date of death</label>
            <input type="date" name="deathday" class="form-control" id="deathday" value="{{ old('deathday') }}">
        </div>

        <div class="form-group">
            <label for="category">Movies</label><br>
            <select class="js-example-basic-multiple" name="movie_id[]" multiple="multiple">
                @foreach ($movies as $movie)
                    <option value="{{ $movie->id }}" {{ (collect(old('movie_id'))->contains($movie->id)) ? 'selected':'' }}>{{ $movie->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
</div>
@endsection