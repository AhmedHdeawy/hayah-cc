<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCenterBranchesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_branches_translations', function (Blueprint $table) {
            $table->increments('center_branches_trans_id');
            $table->string('locale', 191)->index();
            $table->text('name');
            $table->text('address')->nullable();
            $table->text('coupon')->nullable();

            $table->unsignedInteger('center_branches_id');
            $table->foreign('center_branches_id')->references('id')->on('center_branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('center_branches_translations');
    }
}
