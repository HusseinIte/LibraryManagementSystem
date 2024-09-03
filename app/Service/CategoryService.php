<?php

namespace App\Service;

use App\Models\Category;
use Illuminate\Http\Request;

/**
 * Class CategoryService
 * @package App\Service
 */
class CategoryService
{


    /**
     * @return \Illuminate\Database\Eloquent\Collection
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
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return Category::findOrFail($id);
    }


    /**
     * @param $request
     * @param $category
     * @return mixed
     */
    public function update($request, $category)
    {
        return $category->update($request->all());
    }

    /**
     * @param $category
     */
    public function destroy($category)
    {
        $category->delete();
    }
}
