<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationCausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_causes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('desc')->comment('this is the description field');
            $table->float('duration');
            $table->float('maximum_amount');
            $table->text('img');
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
        Schema::dropIfExists('donation_causes');
    }
}
