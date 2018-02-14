@extends('layouts.app')

@section('content')

<div class="row my-3">
    <div class="col">
        <h2>Categories</h2>
        
        {{-- @php
            dd($categories);
        @endphp --}}

        @foreach($categories as $categorie)
        <div class="row mb-3">
            <div class="col-9">
                <ul>
                    <li>
                        <h4>{{ $categorie->name }}</h4>
                        <p>{{ $categorie->description }}</p>
                    </li>
                </ul>
            </div>                
        </div>
        @endforeach
    </div>
    
@endsection
</div>