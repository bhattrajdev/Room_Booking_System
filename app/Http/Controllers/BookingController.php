<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookingController extends Controller
{
    function show()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('room', 'bookings.room_id', '=', 'room.id')
            ->select('bookings.id as booking_id', 'bookings.*', 'room.*')
            ->get();;

        return view('pages.bookings.viewBookings')->with('bookings', $bookings);
    }
    function store(Request $request)
    {
        $user = Auth::user();
        $booking = new Booking();
        $booking->user_id = $user->id;
        $booking->room_id = $request->room_id;
        $booking->startDate = $request->startDate;
        $booking->endDate = $request->endDate;
        $booking->save();

        return redirect()->back()->with('success', 'Room Successfully requested for booking');
    }

    function deleteBooking($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();
            return redirect()->back()->with('success', 'Booking deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->startDate = $request->startDate;
            $booking->endDate = $request->endDate;
            $booking->save();
            return Redirect::route('booking')->with('success', "Booking Updated Successfully");
        } catch (ModelNotFoundException $e) {
            return back()->withError("Booking not found.");
        }
    }


    public function showAll()
    {
        $bookings = Booking::join('users', 'bookings.user_id', '=', 'users.id')
            ->join('room', 'bookings.room_id', '=', 'room.id')
            ->select('bookings.id as booking_id', 'bookings.*', 'room.*', 'users.*')
            ->orderBy('bookings.created_at', 'desc')
            ->get();

        return view('pages.bookings.viewBookings')->with('bookings', $bookings);
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        if ($request->has('action')) {
            $action = $request->input('action');
            if ($action === 'positive') {

                switch ($booking->status) {
                    case "pending": {
                            $booking->status = "processing";
                            break;
                        }
                    case "processing": {
                            $booking->status = "completed";
                            break;
                        }
                    case "rejected": {
                            $booking->status = "processing";
                            break;
                        }
                    default: {
                            $booking->status = "pending";
                            break;
                        }
                }
            }
            if ($action === 'negative') {
                $booking->status = "rejected";
            }
            $booking->save();

            return redirect()->back()->with('success', 'Status updated successfully');
        }
    }
}
