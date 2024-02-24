@extends('layout.layout')
@section('content')
    @if (Auth::check())
        {{-- code for admin dashboard --}}
        @if (Auth::user()->user_type == 1)
            <div class="m-3">
                Admin Dashboard
            </div>
        @else
            {{-- code for user dashboard --}}
            <div class="row">
                @foreach ($room as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ url('uploads/' . $item->image) }}" class="card-img-top" alt="Room Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">{{ $item->description }}</p>
                                <p class="card-text">Price: {{ $item->price }}</p>
                                <a href="/viewDetail/{{ $item['slug'] }}" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @else
        {{-- code for user dashboard --}}
        <div class="row">
            @foreach ($room as $item)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ url('uploads/' . $item->image) }}" class="card-img-top" alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <p class="card-text">Price: {{ $item->price }}</p>
                            <a href="/viewDetail/{{ $item['slug'] }}" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif



@endsection
