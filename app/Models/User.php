<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property string $login Логин
 * @property string $api_token Токен для API
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'login',
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token', 'created_at', 'updated_at', 'login', 'email',
    ];

    /**
     * Продукты пользователя
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Product
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
