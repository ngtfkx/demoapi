<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $name Тег
 * @mixin \Eloquent
 */
class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'pivot',
    ];

    /**
     * Товары, у которых есть этот тег
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Product
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
