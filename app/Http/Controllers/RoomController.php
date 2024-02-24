<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\facility;
use App\Models\category;
use App\Models\room;
use App\Models\room_facility;
use App\Models\image_gallery;
use App\Http\Requests\StorePostRequest;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Redirect;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomsWithCategories = Room::join('category', 'room.category_id', '=', 'category.id')
            ->join('room_facility', 'room.id', '=', 'room_facility.room_id')
            ->select('room.*', 'category.name as category_name')
            ->orderBy('room.id', 'desc')
            ->distinct()
            ->get();

        return view('pages.room.viewRoom')->with('room', $roomsWithCategories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facility = facility::orderBy('id', 'desc')->get();
        $category = category::orderBy('id', 'desc')->get();
        return view('pages.room.addRoom')->with('category', $category)->with('facility', $facility);
    }


    public function store(StorePostRequest $request)

    {
        $room = new room();
        $room->name = $request->name;
        $room->room_no = $request->roomnumber;
        $room->slug = $request->slug;
        $room->category_id = $request->category;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->save();

        $lastInsertedRoom = Room::latest()->first();

        // Save room facilities
        foreach ($request->facilities as $facilityId) {
            $roomFacility = new room_facility();
            $roomFacility->room_id = $lastInsertedRoom->id;
            $roomFacility->facility_id = $facilityId;
            $roomFacility->save();
        }

        // Save room images
        foreach ($request->file('image') as $image) {
            $imageGallery = new image_gallery();
            $filename = microtime() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $filename);

            $imageGallery->room_id = $lastInsertedRoom->id;
            $imageGallery->name = $filename;
            $imageGallery->save();
        }


        return Redirect::route('room.index')->with('success', 'Room added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = room::findOrFail($id);
        $roomFacility = room_facility::where('room_id', $room->id)->get();
        $facility = facility::orderBy('id', 'desc')->get();
        $category = category::orderBy('id', 'desc')->get();

        return view('pages.room.editRoom', compact('room', 'roomFacility', 'facility', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, $id)
    {
        $room = room::findOrFail($id);

        $validatedData =  $request->validated();
        $room->update($validatedData);
        // $room->name = $request->name;
        // $room->room_no = $request->roomnumber;
        // $room->slug = $request->slug;
        // $room->category_id = $request->category;
        // $room->price = $request->price;
        // $room->description = $request->description;
        // $room->save();

        room_facility::where('room_id', $room->id)->delete();

        foreach ($request->facilities as $facility) {
            $roomFacility = new room_facility();
            $roomFacility->room_id = $id;
            $roomFacility->facility_id = $facility;
            $roomFacility->save();
        }

        if ($request->hasFile('image')) {

            foreach ($room->images as $image) {
                $path = public_path('uploads/' . $image);
                if (file_exists($path) && is_file($path)) {
                    unlink($path);
                }
            }


            foreach ($request->file('image') as $image) {
                $filename = microtime() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $filename);

                $room->images()->create([
                    'name' => $filename
                ]);
            }
        }

        return redirect()->route('room.index')->with('success', 'Room updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = room::findOrFail($id);
        room_facility::where('room_id', $room->id)->delete();

        image_gallery::where('room_id', $room->id)->delete();

        $room->delete();

        return redirect()->back()->with('success', 'Room deleted successfully');
    }
}
