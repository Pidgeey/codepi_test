<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CreateRequest;
use App\Http\Requests\Categories\SearchRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\Category;
use App\Http\Resources\Categories\CategoryCollection as CategoryResourceCollection;
use App\Http\Resources\Categories\Category as CategoryResource;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * Get categories list from array of ids
     *
     * @param SearchRequest $request
     * @return CategoryResourceCollection
     */
    public function getCategories(SearchRequest $request): CategoryResourceCollection
    {
        $categories = Category::getCategoriesFromArray($request->input());
        return new CategoryResourceCollection($categories);
    }

    /**
     * Create a category
     *
     * @param CreateRequest $request
     * @return CategoryResource
     */
    public function create(CreateRequest $request): CategoryResource
    {
        $category = Category::createFromArray($request->input());
        return new CategoryResource($category);
    }

    /**
     * Update a category
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return CategoryResource
     */
    public function update(UpdateRequest $request, int $id): CategoryResource
    {
        $category = Category::findOrFail($id);
        $category->updateFromArray($request->input());
        return new CategoryResource($category);
    }
}
