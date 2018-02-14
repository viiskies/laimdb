@extends('layouts.app')

@section('content')
    
    <div class="col-xl-6">
        <form method="post" action="{{ route('categories.store') }}">
            
            @csrf
            <div class="form-group">
                <label for="name">Category name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Category" value="{{ old('name') }}">
            </div>

            @if ($errors->get('name'))
                @foreach ($errors->get('name') as $error)
                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endforeach
            @endif

            <div class="form-group">
                <label for="description">Category description</label>
                <textarea type="text" name="description" class="form-control" id="description" placeholder="Describe your category">{{ old('description') }}</textarea>
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