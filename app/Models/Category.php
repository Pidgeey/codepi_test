<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

/**
 * Class Category
 * @package App\Models
 *
 * @method static create(array $attributes)
 * @method static findOrFail(int $id)
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

    public static function getQueryBuilder(array $filter): Builder
    {
        $builder = static::query();
        if (isset($filter['categories_id'])) {
            $builder->whereIn('id', $filter['categories_id'])->with('characteristics');
        }
        return $builder;
    }

    /**
     * Get categories collection from array of filters
     *
     * @param array $filters
     * @return Collection
     */
    public static function getCategoriesFromArray(array $filters): Collection
    {
        return self::getQueryBuilder($filters)->get(['id', 'name']);
    }

    /**
     * Create a category from an array of attributes
     *
     * @param array $attributes
     * @return static
     */
    public static function createFromArray(array $attributes): self
    {
        return DB::transaction(function () use ($attributes) {
            $category = self::create($attributes);
            if (isset($attributes['characteristics'])) {
                foreach ($attributes['characteristics'] as $characteristicId) {
                    $category->characteristics()->attach($characteristicId);
                }
            }
            return $category;
        });
    }

    /**
     * Update category
     *
     * @param array $attributes
     * @return $this
     */
    public function updateFromArray(array $attributes): self
    {
        return DB::transaction(function () use ($attributes) {
            $this->update($attributes);
            return $this;
        });
    }
}
