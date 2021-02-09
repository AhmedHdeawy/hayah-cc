<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCenterTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_translations', function (Blueprint $table) {
            $table->increments('center_trans_id');
            $table->string('locale', 191)->index();
            $table->text('name');
            $table->text('address')->nullable();

            $table->unsignedInteger('center_id');
            $table->foreign('center_id')->references('id')->on('centers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('center_translations');
    }
}
