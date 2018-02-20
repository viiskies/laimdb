@extends('layouts.app') 

@section('content')
<div class="col-xl-6">
    <form method="post" action="{{ route('actors.update', [ 'actor' => $actor->id ]) }}">
        
        @csrf
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
            <label for="movies">Movies</label>
            <select multiple="multiple" class="custom-select" name="movie_id[]" id="movie">
                {{--  <option selected>Choose...</option>  --}}
                @foreach ($movies as $movie)
                    <option value="{{ $movie->id }}">{{ $movie->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
</div>
@endsection