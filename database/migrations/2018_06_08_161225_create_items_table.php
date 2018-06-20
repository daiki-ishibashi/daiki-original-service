<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('image_url', 100);
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->string('content', 300);
            $table->integer('price');
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('category_masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
