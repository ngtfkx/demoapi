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
 * @property string $photo Фото
 * @property string $photo_desc Описание фото
 * @property-read \App\Models\Category $category
 * @property-read mixed $desc
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read \App\Models\User $user
 * @property-read mixed $photo_url
 */
class Product extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'price', 'name', 'description',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'user_id', 'category_id', 'photo',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    protected $appends = [
        'desc', 'photo_url',
    ];

    /**
     * URL фотографии
     */
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? config('app.url') . '/storage/photos/' . $this->photo : null;
    }

    /**
     * Вывод описания фото
     *
     * @return null|string
     */
    public function getPhotoDescAttribute()
    {
        return $this->photo ? $this->attributes['photo_desc'] : null;
    }

    /**
     * Краткое описание
     *
     * @return string
     */
    public function getDescAttribute()
    {
        return str_limit($this->description, config('app.desc_limit'));
    }

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
