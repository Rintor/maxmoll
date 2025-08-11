@extends('layouts/app')

@section('content')

    <div class="category-show">

        <h2 class="mb-4">{{ $category->name }}</h2>

            @if ($products->isNotEmpty())
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card border text-center h-100">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <div class="p-3 image">
                                        @if ($product->image_url_full)
                                            <img src="{{ asset($product->image_url_full) }}" alt="{{ $product->name }}">
                                        @endif
                                    </div>
                                </a>
                                <div class="card-body">
                                    <h6 class="mb-3">
                                        <a href="{{ route('product.show', $product->slug) }}">
                                            {{ $product->name }}
                                        </a>
                                    </h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="font-weight-bold">{{ $product->price }} ₽</span>
                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalAddToBasket">В корзину</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $products->links() }}
            @else
                <p>Товаровы не найдены</p>
            @endif

    </div>

    @include('blocks.modal-basket')

@endsection