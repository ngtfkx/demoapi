<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $user_id Владелец товар
 * @property int $category_id Находится в категории
 * @property float $price Цена
 * @property string $name Наименование
 * @property string $description Описание
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'price', 'name', 'description',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'user_id', 'category_id',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    /**
     * Владелец товара
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Категория товара
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Теги товара
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Tag
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
