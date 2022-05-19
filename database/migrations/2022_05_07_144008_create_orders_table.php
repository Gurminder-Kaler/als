<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quantities');
            $table->string('product_ids');
            $table->string('discount')->comment('total discount');
            $table->float('total_cost');
            $table->integer('shipping_address_id');
            $table->integer('billing_address_id');
            $table->string('payment_method')->nullable();
            $table->integer('user_id');
            $table->string('status')->comment('pending,refund,delivered,cancelled');
            $table->string('order_id')->comment('uniqueorder_id');
            $table->string('transaction_id')->nullable();
            $table->string('type')->nullable()->comment('multiple or single item');
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
}
