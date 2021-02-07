<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('country_id');
            $table->enum('status', [0, 1])->default(1)->comment('0 => Stopped, 1 => Active');
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        Schema::create('state_translations', function (Blueprint $table) {
            $table->bigIncrements('states_trans_id');
            $table->unsignedBigInteger('state_id');
            $table->string('locale', 3)->default('ar');
            $table->string('name');

            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
        Schema::dropIfExists('state_translations');
    }
}
