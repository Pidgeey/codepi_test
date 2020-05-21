<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class Product
 * @package App\Models
 *
 * @method static create(array $attributes)
 * @method static findOrFail(int $id)
 */
class Product extends Model
{
    use SoftDeletes;

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

    /**
     * Initiate a builder with filters params
     *
     * @param array $filters
     * @return Builder
     */
    public static function getQueryBuilder(array $filters = []): Builder
    {
        $builder = static::query();
        // If soft_deleted products are required
        if ($filters['with_soft_deletes'] ?? false) {
            $builder->withTrashed();
        }
        // Filter by categories
        if (isset($filters['categories'])) {
            // Join with product_has_categories pivot table
            $builder->join('product_has_categories as cat', 'id', '=', 'cat.product_id')
                ->whereIn('cat.category_id', $filters['categories']);
        }
        // Filter by characteristics
        if (isset($filters['characteristics'])) {
            // Join with product_has_characteristics pivot table
            $builder->join('product_has_characteristics as cha', 'id', '=', 'cha.product_id')
                ->whereIn('cha.characteristic_id', $filters['characteristics']);
        }
        return $builder;
    }

    /**
     * Get products list
     *
     * @param array $filters
     * @return Collection
     */
    public static function getProductsList(array $filters = []): Collection
    {
        // Get a collection of products filtered with their relations. Only select id and name for pivot table
        return Product::getQueryBuilder($filters)->with('categories:id,name', 'characteristics:id,name')->get();
    }

    /**
     * Product create
     *
     * @param array $attributes
     * @return static
     */
    public static function createFromArray(array $attributes): self
    {
        return DB::transaction(function () use ($attributes){
            // Create a new product with mass assigment
            $product = self::create($attributes);
            // If categories are presents
            if (isset($attributes['categories'])) {
                foreach ($attributes['categories'] as $categoryId){
                    // Attach category on pivot table
                    $product->categories()->attach($categoryId);
                }
            }
            // If characteristics are presents
            if (isset($attributes['characteristics'])) {
                foreach ($attributes['characteristics'] as $characteristicId) {
                    // Attach characteristic on pivot table
                    $product->characteristics()->attach($characteristicId);
                }
            }
            return $product;
        });
    }

    /**
     * Update a product with an array of attributes
     *
     * @param array $attributes
     * @return $this
     */
    public function updateFromArray(array $attributes): self
    {
        return DB::transaction(function () use ($attributes) {
            // If categories are presents
            if (isset($attributes['categories'])) {
                // Remove all entries from categories pivot table
                $this->categories()->detach();
                foreach ($attributes['categories'] as $categoryId) {
                    // Then create new entries
                    $this->categories()->attach($categoryId);
                }
            }
            // If characteristics are presents
            if (isset($attributes['characteristics'])) {
                // Remove all entries from characteristics pivot table
                $this->characteristics()->detach();
                foreach ($attributes['characteristics'] as $characteristicId) {
                    // Then create new entries
                    $this->characteristics()->attach($characteristicId);
                }
            }
            // Update product with mass assignment
            $this->update($attributes);
            return $this;
        });
    }
}
