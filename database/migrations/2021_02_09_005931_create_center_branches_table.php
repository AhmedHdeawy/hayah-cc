<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCenterBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('discount_value')->nullable();
            $table->string('hours')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('notes')->nullable();
            $table->text('phone')->nullable();
            $table->text('logo')->nullable();
            $table->enum('status', [0, 1])->default(1)->comment('0 => Stopped, 1 => Active');

            $table->unsignedInteger('center_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('governorate_id');
            $table->unsignedInteger('city_id');


            $table->foreign('center_id')->references('id')->on('centers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('governorate_id')->references('id')->on('governorates')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

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
        Schema::dropIfExists('center_branches');
    }
}
