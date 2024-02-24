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
                    <h4>Add Room</h4>
                </div>
                <div class="col-md-6 text-end"><a href="/room"><button class="btn btn-success">View All</button></a>
                </div>
            </div>
        </div>
    </div>


    {{-- form start --}}
    <div class="card card-body m-2 p-3">
        <form action="/room" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="mb-4 col-md-6">
                    <label for="name" class="form-label">Room Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name"
                        oninput="handleChange()">
                </div>
                <div class="mb-4 col-md-6">
                    <label for="roomnumber" class="form-label">Room Number</label>
                    <input type="text" class="form-control" name="roomnumber" value="{{ old('roomnumber') }}"
                        id="roomnumber" oninput="handleChange()">
                </div>
            </div>

            <div class="mb-4">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" name="slug" value="{{ old('slug') }}" id="slug">
            </div>

            <div class="mb-4">
                <label for="" class="form-label">Category</label>
                <select class="form-select" name="category">
                    <option selected disabled>Choose the room category</option>
                    @foreach ($category as $item)
                        <option value="{{ $item->id }}" {{ old('category') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="" class="form-label">Facilities</label>
                <select class="form-select" name="facilities[]" multiple="multiple">
                    @foreach ($facility as $item)
                        <option value="{{ $item->id }}"
                            {{ in_array($item->id, old('facilities', [])) ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>


            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="" class="form-label">Price</label>
                    <input type="text" name="price" value="{{ old('price') }}" class="form-control" />
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Images</label>
                    <input type="file" name="image[]" class="form-control" />
                </div>
            </div>


            <div class="mb-4">
                <label for="" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-success">ADD</button>
            </div>
        </form>
    </div>


    <script>
        handleChange = () => {
            // Get the values of room name and room number inputs
            var roomName = document.getElementById('name').value.trim();
            var roomNumber = document.getElementById('roomnumber').value.trim();

            // Concatenate room name and room number if both are not empty
            var slug = (roomName && roomNumber) ? roomName.toLowerCase() + '-' + roomNumber.toLowerCase() : roomName
                .toLowerCase();

            slug = slug.replace(/\s+/g, '-');
            // Set the slug value to the slug input field
            document.getElementById('slug').value = slug;
        }
    </script>
@endsection
