<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bill_id');
            $table->unsignedInteger('product_id');
            $table->integer('quantity');
            $table->bigInteger('price');

            $table->foreign('bill_id')->references('id')
                ->on('bills')
                ->onDelete('cascade');

            $table->foreign('product_id')->references('id')
                ->on('products');

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
        Schema::dropIfExists('bill_detail');
    }
}
