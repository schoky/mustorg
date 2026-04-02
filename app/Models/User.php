<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Добавляем атрибуты fillable через PHP 8 атрибуты, но также можно через массив
#[Fillable(['name', 'email', 'password', 'address'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * (дублируем для совместимости с версиями PHP < 8, но можно оставить только атрибуты)
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',      // Добавляем поле адреса для доставки
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Связь с арендой (один пользователь может иметь много заявок на аренду)
     */
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    /**
     * Связь с заказами (один пользователь может иметь много заказов)
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Связь "многие ко многим" с избранными товарами
     */
    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites');
    }

    /**
     * Проверка, находится ли товар в избранном у пользователя
     */
    public function hasFavorite($productId)
    {
        return $this->favorites()->where('product_id', $productId)->exists();
    }
}