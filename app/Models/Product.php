<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Получение полного URL изображения товара.
     * Если изображение не задано, возвращает URL картинки-заглушки.
     *
     * @return string
     */
    public function getImageUrlFullAttribute(): string
    {
        return $this->image_url ?: asset('images/uploads/no-image.jpg');
    }
}
