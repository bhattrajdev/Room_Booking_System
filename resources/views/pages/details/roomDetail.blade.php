@extends('layout.layout')

@section('content')
    {{-- code for modal start --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Modal Start-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Book Room</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/booknow" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room[0]['room_id'] }}">
                        <div class="mb-3">
                            <label for="startDate">From:</label>
                            <input type="date" name="startDate" min="{{ date('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="startDate">To</label>
                            <input type="date" name="endDate" min="{{ date('Y-m-d') }}" class="form-control">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal End --}}

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <img src="{{ asset('uploads/' . $room[0]['image']) }}" class="card-img-top" alt="Room Image"
                    style="width: 100%; height: auto;">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $room[0]['name'] }}</h5>
                    <p class="card-text">{{ $room[0]['description'] }}</p>
                    <p class="card-text">Price: ${{ $room[0]['price'] }}</p>
                    <p class="card-text">Category: {{ $room[0]['category_name'] }}</p>
                    <p class="card-text">Facilities: @foreach ($room as $data)
                            {{ $data['facility_name'] . ',' }}
                        @endforeach
                    </p>
                    <a href="{{ route('login', ['redirectto' => Request::path()]) }}" onclick="handleChange(this)"
                        class="btn btn-primary">Book Now</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function handleChange(anchorElement) {
            anchorElement.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default action of the anchor tag

                // Check if the user is logged in
                if ({!! Auth::check() ? 'true' : 'false' !!}) {
                    console.log('User is logged in');
                    var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
                    modal.show();
                } else {
                    console.log('User is not logged in');
                    // If not logged in, redirect to the login page with the redirectto parameter
                    var loginRoute = anchorElement.getAttribute('href');

                    window.location.href = loginRoute;
                }
            });
        }

        // Call handleChange function when the document is loaded
        document.addEventListener('DOMContentLoaded', function() {
            var bookNowButtons = document.querySelectorAll('.btn-primary');
            bookNowButtons.forEach(function(button) {
                handleChange(button);
            });
        });
    </script>


@endsection
