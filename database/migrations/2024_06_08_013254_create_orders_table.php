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
            $table->string('code');
            $table->text('uid');
            $table ->integer('product_id');
            $table ->integer('product_variant_id');
            $table ->text('product');
            $table ->text('product_variant');
            $table ->integer('user_id');
            $table ->integer('quantity');
            $table ->double('price');
            $table ->double('amount');
            $table ->integer('execution_time')->nullable();
            $table ->text('note')->nullable();
            $table ->text('note_admin')->nullable();
            $table ->string('status');
            $table ->index(['product_id', 'product_variant_id', 'user_id'], 'order_index');
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
