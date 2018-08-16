<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->nullable();
            $table->string('url_image')->nullable();
            $table->integer('prioritize')->default(0);
            $table->integer('user_create')->nullable();
            $table->integer('remove')->default(0);
            $table->integer('hot')->default(0);
            $table->integer('view')->default(0);
            $table->integer('vote')->default(0);
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
        Schema::dropIfExists('news');
    }
}
