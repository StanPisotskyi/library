<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(Category::paginate(20));
    }

    /**
     * @param StoreCategory $request
     * @return CategoryResource
     */
    public function store(StoreCategory $request)
    {
        $data = $request->validated();
        $category = new Category();
        $category->fill($data);
        $category->save();

        return CategoryResource::make($category);
    }

    /**
     * @param int $id
     * @param StoreCategory $request
     * @return CategoryResource
     */
    public function update(int $id, StoreCategory $request)
    {
        $data = $request->validated();
        $category = Category::find($id);
        $category->fill($data);
        $category->save();

        return CategoryResource::make($category);
    }
}
