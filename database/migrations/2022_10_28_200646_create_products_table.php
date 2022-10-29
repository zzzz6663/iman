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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();;
            $table->unsignedBigInteger('brand_id')->nullable();;
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
        Schema::dropIfExists('products');
    }
};
