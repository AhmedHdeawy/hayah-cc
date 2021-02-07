<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->string('phone', 40)->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', [0, 1])->default(0)->comment('0 => Stopped, 1 => Active');
            $table->enum('role', [1, 2])->default(1)->comment('1 => Follower, 2 => Subscriber');
            $table->string('youtube_channel')->nullable();
            $table->string('instagram_channel')->nullable();
            $table->string('channel_url')->nullable();
            $table->unsignedInteger('recipes_count')->default(0);
            $table->unsignedInteger('followers_count')->default(0);
            $table->string('provider_name')->nullable();
            $table->string('provider_id')->unique()->nullable();
            $table->unsignedSmallInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
