<?php

namespace App\Http\Resources\Categories;

use App\Http\Resources\Resource;

/**
 * Class Category
 * @package App\Http\Resources\Categories
 */
class Category extends Resource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request),
            [
                'characteristics' => $this->resource->characteristics()->get(['id', 'name'])->toArray()
            ]
        );
    }
}
