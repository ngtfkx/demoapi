<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name')->comment('Наименование');

            $table->text('description')->comment('Описание');

            $table->decimal('price',8, 2)->index()->comment('Цена');

            $table->unsignedInteger('calorific')->default(0)->comment('Калорийность');

            $table->boolean('is_new')->default(1)->comment('Новинка');

            $table->boolean('is_top')->default(0)->comment('Топ-продаж');

            $table->string('photo')->nullable()->comment('Фото');

            $table->string('photo_desc')->nullable()->comment('Описание фото');

            $table->integer('user_id')->unsigned()->comment('Владелец товар');
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('category_id')->unsigned()->comment('Находится в категории');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
