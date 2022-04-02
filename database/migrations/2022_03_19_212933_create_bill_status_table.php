<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });


        Schema::create('payment_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('bill_status');
        Schema::dropIfExists('payment_status');
    }
}
