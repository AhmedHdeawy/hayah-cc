<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_translations', function (Blueprint $table) {
            $table->increments('infos_trans_id');
            $table->unsignedInteger('info_id');
            $table->string('locale', 191)->index();
            $table->string('infos_title', 191)->index();
            $table->text('infos_desc');

            $table->foreign('info_id')->references('id')->on('infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_translations');
    }
}
