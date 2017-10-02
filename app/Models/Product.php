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
    //
}
