<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\CreateRequest;
use App\Http\Requests\Products\SearchRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Product;
use App\Http\Resources\Products\Product as ProductResource;
use App\Http\Resources\Products\ProductCollection as ProductResourceCollection;
use Illuminate\Support\Facades\Response;

/**
 * Class ProductController
 * @package App\Http\Controllers
 * @noinspection PhpUnused
 */
class ProductController extends Controller
{
    /**
     * Get products list according to an array of filters
     *
     * @param SearchRequest $request
     * @return ProductResourceCollection
     */
    public function getProductsList(SearchRequest $request): ProductResourceCollection
    {
        $products = Product::getProductsList($request->input());
        return new ProductResourceCollection($products);
    }

    /**
     * Create a new product
     *
     * @param CreateRequest $request
     * @return ProductResource
     */
    public function create(CreateRequest $request): ProductResource
    {
        $product = Product::createFromArray($request->input());
        return new ProductResource($product);
    }

    /**
     * Product update
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return ProductResource
     */
    public function update(UpdateRequest $request, int $id): ProductResource
    {
        $product = Product::findOrFail($id);
        $product->updateFromArray($request->input());
        return new ProductResource($product);
    }

    /**
     * Delete a product
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        Product::findOrFail($id)->delete();
        return Response::make('', 204);
    }

    /**
     * Restore a soft delete product
     *
     * @param int $id
     * @return ProductResource
     */
    public function restore(int $id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return new ProductResource($product);
    }
}
