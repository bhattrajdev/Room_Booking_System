<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = category::orderBy('id', 'desc')->get();
        return view('pages.category.viewCategory')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
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

        $existing = category::where('name', '=', $request->name)->exists();
        if ($existing) {
            return redirect()->back()->with('error', 'Category Already Exists');
        } else {
            $category = new category();
            $category->name = $request->name;
            $category->save();

            return redirect()->back()->with('success', 'Category Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $category = Category::findOrFail($id);
        // return view('pages.category.viewCategory')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Invalid Data !!!');
        }

        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }

        $existing = Category::where('name', $validatedData['name'])
            ->where('id', '!=', $id)
            ->exists();
        if ($existing) {
            return redirect()->back()->with('error', 'Category with this name already exists');
        }
        // Update the category
        $category->name = $validatedData['name'];
        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        if ($category) {
            $category->delete();
            return redirect()->back()->with('success', 'Category deleted successfully');
        }

        return redirect()->back()->with('error', 'Category deleted successfully');
    }
}
