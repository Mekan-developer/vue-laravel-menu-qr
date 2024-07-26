<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\SizeRequest;
use App\Http\Resources\Food_categoryResource;
use App\Models\Category;
use App\Models\Food;
use App\Models\foodSize;
use App\Models\Image;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $category['parent'] = Food_categoryResource::collection(Category::whereNull('parent_id')->get());
        $category['child'] = Food_categoryResource::collection(Category::whereNotNull('parent_id')->get());

        return response()->json(['message' => 'getting category success', 'parent' => $category['parent'], 'child' => $category['child']]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FoodRequest $foodRequest, ImageRequest $imageRequest, SizeRequest $sizeRequest)
    {
        $foodData = $foodRequest->validated();
        $food = Food::create($foodData);

        // part of adding image begin code
        $imageData = $imageRequest->validated();
        if ($imageRequest->hasFile('image')) {
            $imageData['food_id'] = $food->id;
            foreach ($imageRequest->file('image') as $img) {
                $fileName = $this->uploadFile($img, 'foods');
                $imageData['image'] = $fileName;
                Image::create($imageData);
            }
        }
        // ading image to Image-model end



        $sizeData = $sizeRequest->validated();
        if ($sizeRequest->has("food_sizes")) {
            foreach ($sizeData['food_sizes'] as $value) {
                $size_data = [
                    'name' => json_encode($value->name, true),
                    'food_id' => $food->id,
                    'price' => $value->price,
                ];
                foodSize::create($size_data);
            }
        }

        // $data2 = [
        //     'food_id' => $food->id,
        //     'price' => $request->price,
        // ];
        // foodSize::create($data2);

        return response()->json(['message' => 'foods created successfully']);
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
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
