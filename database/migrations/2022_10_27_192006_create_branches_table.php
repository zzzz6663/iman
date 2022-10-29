<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('username')->nullable();;
            $table->string('company')->nullable();;
            $table->string('person')->nullable();;
            $table->string('phone')->nullable();;
            $table->string('email')->nullable();;
            $table->string('tax')->nullable();;
            $table->string('address')->nullable();;
            $table->string('logo',2500)->nullable();;
            $table->string('password');
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
        Schema::dropIfExists('branches');
    }
};
