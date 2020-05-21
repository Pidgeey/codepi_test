<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Resource;

/**
 * Class Product
 * @package App\Http\Resources\Products
 */
class Product extends Resource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request),
            [
                'categories' => $this->resource->categories()->get(['id', 'name'])->toArray(),
                'characteristics' => $this->resource->characteristics()->get(['id', 'name'])->toArray()
            ]
        );
    }
}
