@extends('layout.layout')
@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>All Rooms</h4>
                </div>
                <div class="col-md-6 text-end"><a href="/room/create"><button class="btn btn-success">+ Add new</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Name</th>
                        <th scope="col">Room No</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($room as $key => $item)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->room_no }}</td>
                            <td>{{ $item->category_name }}</td>
                            <td class="d-flex flex-row gap-2 ">
                                <a href="{{ url('/room/' . $item->id . '/edit') }}"><button class="btn btn-warning"><i
                                            class="fa-solid fa-pen"></i>Edit</button></a>
                                <form action="/room/{{ $item->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this category?')"><i
                                            class="fa-solid fa-trash"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
