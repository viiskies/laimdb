@extends('layouts.app') 

@section('content')
<div class="col-xl-6">
    <form method="post" action="{{ route('movies.update', [ 'movie' => $movie->id ]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('shared.errors')

        <input type="file" name="photo[]" id="photo" multiple>

        <div class="form-group">
            <div class="form-check">
                @foreach ($movie->images as $image)
                    <img src="{{ URL::to('/storage/photos/movies') }}/{{ $image->filename }}" class="img-thumbnail w-25">
                    <input class="form-check-input" name="photo_id[]" type="checkbox" value="{{ $image->filename }}" id="{{ $image->filename }}">         
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="form-radio">
                @foreach ($movie->images as $image)
                    <img src="{{ URL::to('/storage/photos/movies') }}/{{ $image->filename }}" class="img-thumbnail w-25">
                    <input class="form-radio-input" name="featured" type="radio" value="{{ $image->id }}" id="{{ $image->filename }}">         
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name', $movie->name) }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" class="form-control" id="description" placeholder="Category description...">{{ old('description', $movie->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select class="js-example-basic-single" name="category_id">

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                            {{ (old('category_id', $movie->category->id) == $category->id)  ? 'selected':'' }}>{{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="actors">Actors</label>
            <select class="js-example-basic-multiple" name="actor_id[]" multiple="multiple" id="actors">
                @foreach ($actors as $actor)
                    <option value="{{ $actor->id }}"
                            {{ (collect(old('actor_id'))->contains($actor->id)) || $movie->actors->contains('id', $actor->id) ? 'selected':'' }}>{{ $actor->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="text" name="year" class="form-control" id="year" placeholder="Year" value="{{ old('year', $movie->year) }}">
        </div>

        <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
</div>
@endsection