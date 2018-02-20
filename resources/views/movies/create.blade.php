@extends('layouts.app') 

@section('content')
<div class="col-xl-6">
    <form method="post" action="{{ route('movies.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="photo" id="photo">
        {{--  <input type="submit" value="Upload Image" name="submit">  --}}
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
            <select class="custom-select" name="category_id" id="category">
                <option selected>Choose...</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="actors">Actors</label>
            <select multiple="multiple" class="custom-select" name="actor_id[]" id="actors">
                @foreach ($actors as $actor)
                    <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <input type="text" name="year" class="form-control" id="year" placeholder="Year" value="{{ old('year') }}">
        </div>
        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="text" name="rating" class="form-control" id="rating" placeholder="Rating" value="{{ old('rating') }}">
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