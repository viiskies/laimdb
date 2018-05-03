@extends('layouts.app') 

@section('content')
<div class="col-xl-6">
    <form method="post" action="{{ route('movies.store') }}" enctype="multipart/form-data">
        @csrf
        @include('shared.errors')

        <input type="file" name="photo[]" id="photo" multiple>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" class="form-control" id="description" placeholder="Category description...">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select class="js-example-basic-single" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ (collect(old('$category_id'))->contains($category->id)) ? 'selected':'' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category">Actors</label>
            <select class="js-example-basic-multiple" name="actor_id[]" multiple="multiple">
                @foreach ($actors as $actor)
                    <option value="{{ $actor->id }}" {{ (collect(old('actor_id'))->contains($actor->id)) ? 'selected':'' }}>{{ $actor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="text" name="year" class="form-control" id="year" placeholder="Year" value="{{ old('year') }}">
        </div>

        <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
</div>
@endsection