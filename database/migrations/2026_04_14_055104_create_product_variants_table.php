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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->constrained("products")->onDelete("cascade");
            $table->enum("size", ["S", "M", "L", "XL", "XXL", "FREE SIZE"]);
            $table->string("color");
            $table->string("color_hex", 7)->nullable();
            $table->integer("stock")->default(0);
            $table->integer("price_adjustment")->default(0);
            $table->string("sku")->unique();
            $table->timestamps();
            $table->unique(["product_id", "size", "color"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
};
