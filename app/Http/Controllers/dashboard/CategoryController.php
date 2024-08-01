<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryfoodResource;
use App\Http\Resources\CategoryResource;

use App\Http\Resources\Food_categoryResource;
use App\Http\Resources\FoodResource;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $req)
    {

        if ($req->parent) {
            $categories = Category::whereNotNull('parent_id')->with('parent')->get();
        } else
            $categories = Category::whereNull('parent_id')->get();
        return CategoryResource::collection($categories);
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
    public function store(CategoryRequest $request)
    {

        $names = json_decode($request->name, true);
        $is_active = filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN);
        $data = [
            'name' => $names,
            'is_active' => $is_active,
        ];
        if ($request->parent_id) {
            $data['parent_id'] = $request->parent_id;
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $this->uploadFile($file, 'categories');
        }
        $data['image'] = $fileName;
        Category::create($data);
    }

    /**
     * Display the specified resource.
     */
    // public function show(c $c)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $category->load('parent');
        $category = new CategoryResource($category);

        return response()->json(['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category, CategoryRequest $request)
    {



        $names = json_decode($request->name, true);
        $is_active = filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN);
        $data = [
            'name' => $names,
            'is_active' => $is_active,
            'parent_id' => $request->parent_id
        ];

        if ($request->hasFile('image')) {
            $this->removeFile($category->image, 'categories');//remove file when edited
            $file = $request->file('image');
            $fileName = $this->uploadFile($file, 'categories');//upload file
            $data['image'] = $fileName;
        }
        // dd($data);

        $category->update($data);
        return response()->json(['message' => 'Category updated successfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, $id)
    {
        $category = Category::findOrFail($id);

        if ($category->image) {
            $this->removeFile($category->image, 'categories');
        }
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
