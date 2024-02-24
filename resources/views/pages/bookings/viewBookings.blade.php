    @extends('layout.layout')
    @section('content')
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>All Bookings
                        </h4>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Start For Booking edit -->
        <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Bookings</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editCategoryForm" method="POST" action="{{ url('/bookings/{id}') }}">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="startDate">From:</label>
                                <input type="date" name="startDate" id="startDate" min="{{ date('Y-m-d') }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="startDate">To</label>
                                <input type="date" name="endDate" id="endDate" min="{{ date('Y-m-d') }}"
                                    class="form-control">
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
        <!-- Modal End For Booking edit -->
        {{-- code for table --}}
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    {{-- for booking routes --}}
                    @if (Route::currentRouteName() === 'booking')
                        <thead>
                            <tr>
                                <th scope="col">S.N</th>
                                <th scope="col">Name</th>
                                <th scope="col">To</th>
                                <th scope="col">From</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        @foreach ($bookings as $key => $booking)
                            <tr>
                                <td scope="col">{{ ++$key }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->startDate }}</td>
                                <td>{{ $booking->endDate }}</td>
                                <td>{{ $booking->status }}</td>
                                <td class="d-flex flex-row gap-2 ">


                                    <button class="btn btn-warning edit-btn" data-bs-toggle="modal"
                                        {{ $booking->status != 'pending' ? 'disabled' : '' }}
                                        data-bs-target="#editCategoryModal" data-id="{{ $booking->booking_id }}"
                                        data-endDate="{{ $booking->endDate }}" data-startDate="{{ $booking->startDate }}">
                                        <i class="fa-solid fa-pen"></i>Edit</button>
                                    <form action="/bookings/{{ $booking['booking_id'] }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger"
                                            {{ $booking->status != 'pending' ? 'disabled' : '' }}
                                            onclick="return confirm('Are you sure you want to delete this booking?')"><i
                                                class="fa-solid fa-trash"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    {{-- for booking.all routes --}}
                    @if (Route::currentRouteName() === 'bookings.all')
                        <thead>
                            <tr>
                                <th scope="col">S.N</th>
                                <th scope="col">Name</th>
                                <th scope="col">Room no</th>
                                <th scope="col">To</th>
                                <th scope="col">From</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        @foreach ($bookings as $key => $booking)
                            <tr>
                                <td scope="col">{{ ++$key }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->room_no }}</td>
                                <td>{{ $booking->startDate }}</td>
                                <td>{{ $booking->endDate }}</td>
                                <td>{{ $booking->status }}</td>
                                <td class="d-flex flex-row gap-2 ">
                                    <form action="/booking/status/{{ $booking['booking_id'] }}" method="POST">
                                        @method('put')
                                        @csrf
                                        <button class="btn btn-primary" name="action" value="positive"
                                            onclick="return confirm('Are you sure you want to update this Status?')"><i
                                                class="fa-solid fa-pen"></i>Accept</button>

                                        <button class="btn btn-warning" name="action" value="negative"
                                            onclick="return confirm('Are you sure you want to update this Status?')"><i
                                                class="fa-solid fa-circle-xmark"></i>Reject</button>
                                    </form>
                                    <form action="/bookings/{{ $booking['booking_id'] }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this booking?')"><i
                                                class="fa-solid fa-trash"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif


                </table>
                </tbody>
                </table>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var editButtons = document.querySelectorAll('.edit-btn');

                editButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        var bookingId = this.getAttribute('data-id');
                        var startDate = this.getAttribute('data-startDate');
                        var endDate = this.getAttribute('data-endDate');

                        document.getElementById('startDate').value = startDate;
                        document.getElementById('endDate').value = endDate;

                        document.getElementById('editCategoryForm').setAttribute('action',
                            '/bookings/' + bookingId);


                        document.getElementById('editCategoryModal').classList.add('show');
                    });
                });
            });
        </script>
    @endsection
