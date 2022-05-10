<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->text('company_house_no');
            $table->string('country');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code');
            $table->string('address_line_one');
            $table->string('address_line_two')->nullable();
            $table->integer('user_id');
            $table->string('type')->comment('shipping address,delivery address');
            $table->boolean('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('addresses');
    }
}
