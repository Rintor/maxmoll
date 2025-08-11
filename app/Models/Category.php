<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * В модели нет меток времени created_at/updated_at.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Scope для фильтрации категорий по slug.
     *
     * @param Builder $query
     * @param string $slug
     * @return Builder
     */
    public function scopeBySlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    /**
     * Получить рабочий slug категории.
     * Если поле slug пустое — генерируется из названия.
     *
     * @return string
     */
    public function getEffectiveSlug(): string
    {
        return $this->slug ?: Str::slug($this->name);
    }

    /**
     * Получить полный URL категории.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return url('/category/' . $this->getEffectiveSlug());
    }

    /**
     * Получить коллекцию категорий с добавленным свойством url.
     *
     * @return Collection|static[]
     */
    public static function getNameAndUrl(): Collection
    {
        return self::all()->map(function (self $category) {
            $category->url = $category->getUrl();

            return $category;
        });
    }

    /**
     * Связь "один ко многим" с продуктами категории.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
