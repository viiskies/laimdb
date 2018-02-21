@extends('layouts.app') 

@section('content')
<div class="col-xl-6">
    <form method="post" action="{{ route('movies.update', [ 'movie' => $movie->id ]) }}">
        @csrf
        @foreach ($movie->images as $image)
            <img src="{{URL::to('/storage/photos/movies')}}/{{ $image->filename }}" class="img-thumbnail w-25"> 
        @endforeach

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
                    {{--  @if (in_array($category, $movie->categories->all()))  --}}
                    @if ($category == $movie->category)
                        <input class="form-radio-input" type="radio" value="{{ $category->id }}" id="{{ $category->name }}" checked>
                    @else
                        <input class="form-radio-input" type="radio" value="{{ $category->id }}" id="{{ $category->name }}">
                    @endif 
                    <label class="form-radio-label" for="{{ $category->name }}">{{ $category->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="category">Actors</label> 
            @foreach ($actors as $actor)
                <div class="form-check">
                    @php
                        // dump($actor);
                        // dd($movie->actors->all());
                    @endphp
                    @if (in_array($actor, $movie->actors->all()))
                        <input class="form-check-input" type="checkbox" value="{{ $actor->id }}" id="{{ $actor->name }}" checked>
                    @else
                        <input class="form-check-input" type="checkbox" value="{{ $actor->id }}" id="{{ $actor->name }}">
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