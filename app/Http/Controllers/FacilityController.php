<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\facility;
use Illuminate\Validation\ValidationException;


class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = facility::orderBy('id', 'desc')->get();
        return view('pages.facility.viewFacility')->with('data', $data);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Invalid Data !!!');
        }

        $existing = facility::where('name', '=', $request->name)->exists();
        if ($existing) {
            return redirect()->back()->with('error', 'Facility Already Exists');
        } else {
            $category = new facility();
            $category->name = $request->name;
            $category->save();

            return redirect()->back()->with('success', 'Facility Added Successfully');
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { {
            try {
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                ]);
            } catch (ValidationException $e) {
                return redirect()->back()->with('error', 'Invalid Data !!!');
            }

            $facility = facility::find($id);
            if (!$facility) {
                return redirect()->back()->with('error', 'Facility not found');
            }

            $existing = facility::where('name', $validatedData['name'])
            ->where('id', '!=', $id)
                ->exists();
            if ($existing) {
                return redirect()->back()->with('error', 'Facility with this name already exists');
            }

          
            $facility->name = $validatedData['name'];
            $facility->save();

            return redirect()->back()->with('success', 'Facility updated successfully');
        }    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $facility = facility::findOrFail($id);
        if ($facility) {
            $facility->delete();
            return redirect()->back()->with('success', 'Facility deleted successfully');
        }

        return redirect()->back()->with('error', 'Facility deleted successfully');
    }
    }

