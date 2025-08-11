<div class="container">
    <div class="nav-top d-flex align-items-center border flex-column flex-md-row">
        <div class="logo mx-3"></div>
        <div class="mr-3">
            <i class="fas fa-location-dot"></i>
            Москва, Кремль
        </div>
        <div class="mr-3">
            <i class="fas fa-phone"></i>
            <a href="tel:+78005553535">8-800-555-3535</a>
        </div>
        <div class="ml-0 mr-0 ml-md-auto mr-md-3">
            <i class="fas fa-cart-shopping fa-2x"></i>
        </div>
    </div>
    <nav class="nav-bottom navbar navbar-expand-lg navbar-light border">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Главная</a>
                </li>
                <li class="nav-item dropdown {{ Route::is('product*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Каталог
                    </a>
                    <div class="dropdown-menu">
                        @if ($categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <a class="dropdown-item" href="{{ $category->url }}">{{ $category->name }}</a>
                            @endforeach
                        @else
                            <p>Категории не найдены</p>
                        @endif
                    </div>
                </li>
                <li class="nav-item {{ Route::is('about') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('about') }}">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Админ-панель</a>
                </li>
            </ul>
        </div>
    </nav>
</div>