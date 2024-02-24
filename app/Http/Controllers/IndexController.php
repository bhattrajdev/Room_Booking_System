<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\room;
use App\Models\room_facility;


class IndexController extends Controller
{
    function index()
    {
        $room = Room::join('image_gallery', 'room.id', '=', 'image_gallery.room_id')
            ->select('room.*', 'image_gallery.name as image')
            ->get();
        return view('pages.index')->with('room', $room);
    }

    function roomDetail($slug)
    {
        $room = Room::where('slug', $slug)
            ->join('image_gallery', 'room.id', '=', 'image_gallery.room_id')
            ->join('room_facility', 'room.id', '=', 'room_facility.room_id')
            ->join('facility', 'room_facility.facility_id', '=', 'facility.id')
            ->join('category', 'room.category_id', '=', 'category.id')
            ->select(
                'room.id as room_id',
                'room.*',
                'image_gallery.name as image',
                'category.name as category_name',
                'facility.name as facility_name',
                'room_facility.*'
            )
            ->get();


        if (!$room) {
            return redirect('/')->with('error', "Room not found");
        }

        return view('pages.details.roomDetail')->with('room', $room);
    }
}
