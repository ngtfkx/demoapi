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
                <div style="width: 30%; height: 300px; border: 1px solid; margin: 4px; padding: 10px; float: left;">
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
                    @if($product->calorific)
                        <span class="pull-right">Калорий: {{ $product->calorific }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
