@extends('layouts.app') 

@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/voteUpdate.js') }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-center mt-3">
            {{ $movies->links() }}
            <h4 class="pl-3">
                Total movies found: {{ $movies->total() }}
            </h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Movie</th>
                    <th scope="col">Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                <tr>
                    <th scope="row">{{ $movies->firstItem() + $loop->index }}.</th>
                    <td>
                        <a href="{{ route('movies.show', ['id' => $movie->id]) }}" class="text-light">
                            {{ $movie->name }} ({{ $movie->year }})
                        </a>
                    </td>
                    <td>{{ $movie->rating }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection