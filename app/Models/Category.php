<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Category
 * @package App\Models
 *
 * @method static create(array $attributes)
 */
class Category extends Model
{
    /**
     * Available attributes for mass assignment
     *
     * @var string[]
     */
    protected $fillable = ['name'];

    /**
     * Products relation
     *
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_has_categories',
            'category_id',
            'product_id'
        );
    }

    /**
     * Characteristics relation
     *
     * @return BelongsToMany
     */
    public function characteristics()
    {
        return $this->belongsToMany(
            Characteristic::class,
            'category_has_characteristics',
            'category_id',
            'characteristic_id'
        );
    }
}
