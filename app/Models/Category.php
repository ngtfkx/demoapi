<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $parent_id Родительская категория
 * @property string $name Наименование
 * @property string $description Описание
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $children
 * @property-read \App\Models\Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 */
class Category extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     * Товары  категории
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Product
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Родительская категория
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Category
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    /**
     * Дочерние категории
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Category
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
