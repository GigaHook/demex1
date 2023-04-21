@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Корзина</h3>
    <div class="row">
        @foreach ($cartItems as $cartItem)
            <div class="col-3 mb-4">  
                <div class="card">
                    <div class="card-header">
                        {{ $cartItem->title }} 
                    </div>
                    <div class="card-body">    

                        <img src="{{ Storage::url($cartItem->image) }}" class="img-thumbnail" style="height: 156px;min-width: 100%;"><br>

                        @switch($cartItem->censorship)
                            @case('0+')
                                <span class="badge badge-success">{{ $cartItem->censorship }}</span>
                                @break
                            @case('6+')
                                <span class="badge badge-primary">{{ $cartItem->censorship }}</span>
                                @break
                            @case('12+')
                                <span class="badge badge-info">{{ $cartItem->censorship }}</span>
                                @break
                            @case('16+')
                                <span class="badge badge-warning">{{ $cartItem->censorship }}</span>
                                @break
                            @case('18+')
                                <span class="badge badge-danger">{{ $cartItem->censorship }}</span>
                                @break
                            @default
                                <span class="badge badge-secondary">Без возростного рейтинга</span>
                        @endswitch
                        <br>
                        Кол-во билетов:<b> {{ $cartItem->quantity }}</b>
                    </div>
                    <div class="card-footer px-2">
                        <form class="d-inline" action="{{ route('cartRemove') }}" method="POST">
                            @csrf
                            <input type="number" name="id" value="{{ $cartItem->film_id }}" hidden>
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                        <form class="d-inline" action="{{ route('cartIncrease') }}" method="POST">
                            @csrf
                            <input type="text" name="id" value="{{ $cartItem->film_id }}" hidden>
                            <button type="submit" class="btn btn-secondary" style="height: 37px; width:37px">+</button>
                        </form>
                        <form class="d-inline" action="{{ route('cartRemoveOrDecrease') }}" method="POST">
                            @csrf
                            <input type="text" name="id" value="{{ $cartItem->film_id }}" hidden>
                            <button type="submit" class="btn btn-secondary" style="height: 37px; width:37px;">-</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{ route('orderCreate') }}" class="btn btn-danger">Оформить заказ</a>
    </div>
@endsection
