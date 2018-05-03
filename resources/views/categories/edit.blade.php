@extends('layouts.app') 
@section('content')
<div class="col-xl-6">
    <form method="post" action="{{ route('categories.update', [ 'category' => $category->id ]) }}">
        @csrf
        @method('PUT')
        @include('shared.errors')

        <div class="form-group">
            <label for="name">Category</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Category" value="{{ old('name', $category->name) }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" class="form-control" id="description" placeholder="Category description...">{{ old('description', $category->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
</div>
@endsection