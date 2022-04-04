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
            $table->string('name', 150)->unique();
            $table->integer('quantity');
            $table->string('NXB');
            $table->integer('NamXB');
            $table->string('author');
            $table->bigInteger('price');
            $table->integer('sale')->nullable();
            $table->integer('status');
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('image');
            $table->unsignedInteger('category_id');

            $table->foreign('category_id')->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('products');
    }
}
