@extends('layouts.app')

@section('content')

<div class="row my-3">
    <div class="col">
        <h2>Categories</h2>
        @foreach($categories as $category)
        <div class="row mb-3">
            <div class="col-9">
                <ul>
                    <li>
                        <h4>{{ $category->name }}</h4>
                        <p>{{ $category->description }}</p>
                        <p>Created by: {{ $category->user->name }}</p>
                    </li>
                </ul>
            </div>                
        </div>
        @endforeach
    </div>
    
@endsection
</div>