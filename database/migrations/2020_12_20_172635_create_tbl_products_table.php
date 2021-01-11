<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->id();
            $table ->string('product_name');
            $table ->integer('category_id');
            $table ->integer('brand_id');
            $table->string('product_desc');
            $table->string('product_price');
            $table->string('product_content');
            $table->string('product_image');
            $table->string('product_size');
            $table->string('product_color');
            $table->integer('product_status');
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
        Schema::dropIfExists('tbl_products');
    }
}
