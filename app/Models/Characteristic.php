<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Characteristic
 * @package App\Models
 *
 * @method static create(array $attributes)
 */
class Characteristic extends Model
{
    /**
     * Available attributes for mass assignment
     *
     * @var string[]
     */
    protected $fillable = ['name'];

    /**
     * Attributes to hidden
     *
     * @var string[]
     */
    protected $hidden = ['pivot'];

    /**
     * Products relation
     *
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_has_characteristics',
            'characteristic_id',
            'product_id'
        );
    }

    /**
     * Categories relation
     *
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'category_has_characteristics',
            'characteristic_id',
            'category_id'
        );
    }
}
