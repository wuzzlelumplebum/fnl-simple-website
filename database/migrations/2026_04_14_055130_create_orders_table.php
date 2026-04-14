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
            $table->foreignId("user_id")->constrained("users");
            $table->string("order_number")->unique();
            $table->enum('status',['pending','confirmed','processing','shipped','delivered','cancelled'])->default('pending');
            $table->string('shipping_address');
            $table->string('courier')->nullable();         // jne, jnt, sicepat
            $table->string('courier_service')->nullable();  // REG, YES, BEST
            $table->string('tracking_number')->nullable();
            $table->integer('subtotal')->default(0);        // All IDR integers
            $table->integer('discount_amount')->default(0);
            $table->integer('shipping_cost')->default(0);
            $table->integer('total')->default(0);
            $table->string('payment_method')->nullable();   // midtrans, stripe
            $table->string('payment_status')->default('unpaid');
            $table->string('midtrans_order_id')->nullable();
            $table->string('stripe_payment_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
