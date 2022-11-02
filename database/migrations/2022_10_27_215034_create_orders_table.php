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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();;

            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            // $table->foreign('order_id')->references('id')->on('curts')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('brand_id')->nullable();;
            $table->string('name',2500)->nullable();;
            $table->string('traffic_code',2500)->nullable();;
            $table->string('barcode',2500)->nullable();;
            $table->text('description')->nullable();;
            $table->integer('width')->nullable();;
            $table->integer('height')->nullable();;
            $table->string('unit',2500)->nullable();;
            $table->integer('inw')->nullable();;
            $table->integer('igw')->nullable();;
            $table->string('volume',2500)->nullable();;
            $table->integer('price')->nullable();;
            $table->string('south_code')->nullable();;
            $table->string('euro_number')->nullable();;
            $table->unsignedBigInteger('quantity')->nullable();;
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
};
