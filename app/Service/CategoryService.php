<?php

namespace App\Service;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|min:3|max:25'
        ]);
        return Category::create([
            'name' => $validated['name']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $category)
    {
        return $category->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category)
    {
        $category->delete();
    }
}
