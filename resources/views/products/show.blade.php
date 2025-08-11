@extends('layouts/app')

@section('content')

    <div class="product-show">

        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    @if ($product->image_url_full)
                        <img class="image" src="{{ asset($product->image_url_full) }}" alt="{{ $product->name }}">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body pl-3">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text h5 mb-3">{{ $product->price }} ₽</p>
                        <p class="card-text"><a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalAddToBasket">В корзину</a></p>
                    </div>
                </div>
            </div>
        </div>

        @if ($product->description)
            <p>{!! nl2br(e($product->description)) !!}</p>
        @endif

    </div>

    @include('blocks.modal-basket')

@endsection