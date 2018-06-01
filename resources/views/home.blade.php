<?php /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products */ ?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <form action="">
                <div class="form-group">
                    <label for="query">Цена</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="price_from" id="price_from"
                                   placeholder="От">
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="price_till" id="price_till"
                                   placeholder="До">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="query">Калорийность</label>
                    <select class="form-control" name="calorific" id="calorific">
                        <option value="">Выбрать</option>
                        <option value="0">Не указана</option>
                        <option value="1">Мало</option>
                        <option value="2">Средне</option>
                        <option value="3">Много</option>
                    </select>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_top" id="is_top" value="1">
                        Топ-продаж
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_new" id="is_new" value="1">
                        Новинка
                    </label>
                </div>
                <div class="form-group">
                    <label for="query">Описание</label>
                    <input type="text" class="form-control" name="query" id="query" placeholder="">
                    <p class="help-block">Поиск по наименованию, описанию товара, описанию фото.</p>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-search"></i>
                    Искать
                </button>
            </form>
        </div>
        <div class="col-md-9">
<pre>
{!! $sql !!}
</pre>
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
