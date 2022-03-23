<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->char('phone', 12)->nullable();
            $table->char('phone_other', 12)->nullable();
            $table->string('work_time')->nullable();
            $table->string('address')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('description')->nullable();
            $table->string('facebook')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
