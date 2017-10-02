<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
