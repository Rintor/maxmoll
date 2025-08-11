<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Отображает главную страницу.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('pages.index', [
            'title' => 'Интернет магазин велосипедов и аксессуаров',
            'meta' => [
                'description' => 'В нашем интернет магазине Вы сможете приобрести надежный велосипед и аксессуары к нему',
                'keywords' => 'купить велосипед, интернет магазин велосипедов',
                'title' => 'Интернет магазин велосипедов и аксессуаров',
            ],
        ]);
    }

    /**
     * Отображает страницу "О нас".
     *
     * @return \Illuminate\View\View
     */
    public function about(): View
    {
        return view('pages.about', [
            'title' => 'Заголовок',
            'meta' => [
                'description' => 'Описание',
                'keywords' => 'ключ1, ключ2',
                'title' => 'Заголовок',
            ],
        ]);
    }
}
