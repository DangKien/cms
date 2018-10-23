<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlipbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flipbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 500)->nullable();
            $table->string('slug', 500)->nullable();
            $table->string('url_image', 300)->nullable();
            $table->string('url_flipbook', 300)->nullable();
            $table->string('status', 10)->default('AVAILABLE');
            $table->double('view', 15, 0)->default(0);
            $table->integer('sort_by')->nullable();

            $table->string('meta_title', 500)->nullable();
            $table->string('meta_content', 500)->nullable();
            $table->string('meta_description', 500)->nullable();
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
        Schema::dropIfExists('flipbooks');
    }
}
