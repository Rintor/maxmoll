<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use \Illuminate\View\View;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Отображает товары выбранной категории.
     *
     * @param string $slug Слаг категории
     * @return \Illuminate\View\View
     */
    public function byCategory(string $slug): View
    {
        $category = Category::bySlug($slug)->firstOrFail();

        $products = $category->products()->paginate(6);

        return view('products.list', [
            'category' => $category,
            'products' => $products,

            'title' => $category->name,
            'meta' => [
                'description' => 'Купить товары в разделе ' . $category->name,
                'keywords' => 'ключ1, ключ2',
                'title' => $category->name,
            ],
        ]);
    }
    
    /**
     * Отображает товар
     *
     * @param string $slug Слаг товара
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $meta = [
            'keywords' => 'ключ1, ключ2',
            'title' => $product->name,
            'image' => $product->image_url_full,
        ];

        if (! empty($product->description)) {
            $meta['description'] = Str::limit($product->description, 160);
        }

        return view('products.show', [
            'product' => $product,
            'title' => $product->name,
            'meta' => $meta,
        ]);
    }
}
