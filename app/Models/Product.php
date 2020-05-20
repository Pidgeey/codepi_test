<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Product
 * @package App\Models
 *
 * @method static create(array $attributes)
 */
class Product extends Model
{
    /**
     * Available attributes for mass assignment
     *
     * @var string[]
     */
    protected $fillable = ['name'];

    /**
     * Categories relation
     *
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class,
            'product_has_categories',
            'product_id',
            'category_id'
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
            'product_has_characteristics',
            'product_id',
            'characteristic_id'
        );
    }
}
