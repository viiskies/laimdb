@extends('layouts.app') 

@section('content')
<div class="col-xl-6">
    <form method="post" action="{{ route('movies.update', [ 'movie' => $movie->id ]) }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="photo[]" id="photo" multiple>
        <div class="form-group">
            <div class="form-check">
                @foreach ($movie->images as $image)
                    <img src="{{URL::to('/storage/photos/movies')}}/{{ $image->filename }}" class="img-thumbnail w-25">
                    <input class="form-check-input" name="photo_id[]" type="checkbox" value="{{ $image->filename }}" id="{{ $image->filename }}">         
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <div class="form-radio">
                @foreach ($movie->images as $image)
                    <img src="{{URL::to('/storage/photos/movies')}}/{{ $image->filename }}" class="img-thumbnail w-25">
                    <input class="form-radio-input" name="featured" type="radio" value="{{ $image->id }}" id="{{ $image->filename }}">         
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $movie->name }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" class="form-control" id="description" placeholder="Category description...">{{ $movie->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            @foreach ($categories as $category)
                <div class="form-radio">
                    @if ($category == $movie->category)
                        <input class="form-radio-input" name="category_id" type="radio" value="{{ $category->id }}" id="{{ $category->name }}" checked>
                    @else
                        <input class="form-radio-input" name="category_id" type="radio" value="{{ $category->id }}" id="{{ $category->name }}">
                    @endif 
                    <label class="form-radio-label" for="{{ $category->name }}">{{ $category->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="category">Actors</label> 
            @foreach ($actors as $actor)
                <div class="form-check">
                    @if ($movie->actors->contains($actor))
                        <input class="form-check-input" name="actor_id[]" type="checkbox" value="{{ $actor->id }}" id="{{ $actor->name }}" checked>
                    @else
                        <input class="form-check-input" name="actor_id[]" type="checkbox" value="{{ $actor->id }}" id="{{ $actor->name }}">
                    @endif
                    <label class="form-check-label" for="{{ $actor->name }}">{{ $actor->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="text" name="year" class="form-control" id="year" placeholder="Year" value="{{ $movie->year }}">
        </div>

        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="text" name="rating" class="form-control" id="rating" placeholder="Rating" value="{{ $movie->rating }}">
        </div>
        
        @if ($errors->get('name')) 
            @foreach ($errors->get('name') as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach 
        @endif

        @if ($errors->get('description'))
            @foreach ($errors->get('description') as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach 
        @endif
        
        @if ($errors->get('category')) 
            @foreach ($errors->get('category') as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach 
        @endif
        
        @if ($errors->get('year')) 
            @foreach ($errors->get('year') as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach 
        @endif
        
        <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
</div>
@endsection