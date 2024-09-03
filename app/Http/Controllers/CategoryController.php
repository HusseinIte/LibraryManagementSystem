<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Service\CategoryService;
use Illuminate\Http\Request;
use function Carbon\this;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->index();
        return $this->sendResponse($categories, 'Categories has been retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = $this->categoryService->store($request);
        return $this->sendResponse($category, 'Category has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = $this->categoryService->show($id);
        return $this->sendResponse($category, 'Category has been retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category = $this->categoryService->update($request, $category);
        return $this->sendResponse($category, 'Category has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $id = $category->id;
        $this->categoryService->destroy($category);
        return response()->json(['message' => 'category with id ' . $id . ' deleted successfully.'], 200);
    }
}
