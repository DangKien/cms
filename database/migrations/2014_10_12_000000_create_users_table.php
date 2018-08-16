<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable();
            $table->string('email', 150)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('provider_id', 250)->nullable();
            $table->string('provider', 250)->nullable();
            $table->string('admin', 250)->nullable();
            $table->string('avatar', 250)->nullable();
            $table->string('password')->nullable();
            $table->string('status', 10)->default('AVAILABLE');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
