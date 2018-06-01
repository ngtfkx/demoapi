<?php /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products */ ?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            Menu
        </div>
        <div class="col-md-9">
            @foreach($products as $product)
                <div class="card">
                    <div>
                        <img src="{{ $product->getPhotoUrlAttribute() }}" style="width: 100%;">
                        @if($product->isTop())
                            <i class="fas fa-heart" title="Топ-продаж"></i>
                        @endif
                        @if($product->isNew())
                            <i class="fas fa-sun" title="Новинка"></i>
                        @endif
                    </div>
                    <h4>{{ $product->name }}</h4>
                    <span class="pull-left">Цена: {{ $product->price }}$</span>
                    <span class="pull-right">
                        Калорий:
                        @switch($product->calorific)
                            @case(0)
                            Не указано
                            @break;
                            @case(1)
                            Мало
                            @break;
                            @case(2)
                            Средне
                            @break;
                            @case(3)
                            Много
                            @break;
                        @endswitch
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
