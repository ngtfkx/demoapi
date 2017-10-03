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

            $table->integer('user_id')->unsigned()->comment('Владелец товар');
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('category_id')->unsigned()->comment('Находится в категории');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->decimal('price',8, 2)->index()->comment('Цена');

            $table->string('name')->comment('Наименование');
            $table->text('description')->comment('Описание');
            $table->string('photo')->nullable()->comment('Фото');
            $table->string('photo_desc')->nullable()->comment('Описание фото');
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
