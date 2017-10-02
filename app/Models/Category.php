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
 */
class Category extends Model
{
    //
}
