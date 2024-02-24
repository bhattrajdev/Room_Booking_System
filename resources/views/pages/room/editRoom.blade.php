@extends('layout.layout')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card mb-4 m-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Edit Room</h4>
                </div>
                <div class="col-md-6 text-end">
                    <a href="/room"><button class="btn btn-success">View All</button></a>
                </div>
            </div>
        </div>
    </div>

    {{-- Form start --}}
    <div class="card card-body m-2 p-3">
        <form action="/room/{{ $room->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="mb-4 col-md-6">
                    <label for="name" class="form-label">Room Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $room->name }}" id="name">
                </div>
                <div class="mb-4 col-md-6">
                    <label for="roomnumber" class="form-label">Room Number</label>
                    <input type="text" class="form-control" name="roomnumber" value="{{ $room->room_no }}"
                        id="roomnumber">
                </div>
            </div>

            <div class="mb-4">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" name="slug" value="{{ $room->slug }}" id="slug">
            </div>

            <div class="mb-4">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category">
                    <option selected disabled>Choose the room category</option>
                    @foreach ($category as $item)
                        <option value="{{ $item->id }}" {{ $room->category_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="facilities" class="form-label">Facilities</label>
                <select class="form-select" name="facilities[]" multiple="multiple">
                    @foreach ($facility as $f)
                        <option value="{{ $f->id }}"
                            {{ $roomFacility->contains('facility_id', $f->id) ? 'selected' : '' }}>
                            {{ $f->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="price" value="{{ $room->price }}" class="form-control" />
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Images</label>
                    <input type="file" name="image[]" class="form-control" />
                </div>
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ $room->description }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-success">Update</button>
            </div>
        </form>
    </div>


@endsection
