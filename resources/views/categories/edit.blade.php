@extends('layouts.app') 
@section('content')
<div class="col-xl-6">
    <form method="post" action="{{ route('categories.update', [ 'category' => $category->id ]) }}">
        @csrf
        <div class="form-group">
            <label for="name">Catgeory</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Category" value="{{ $category->name }}">
        </div>
        @if ($errors->get('name')) 
            @foreach ($errors->get('name') as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach 
        @endif
        <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" class="form-control" id="description" placeholder="Category description...">{{ $category->description }}</textarea>
        </div>
        @if ($errors->get('description')) 
            @foreach ($errors->get('description') as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach 
        @endif
        <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
</div>
@endsection