<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersEventsPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_events_posts', function (Blueprint $table) {
            $table->id();
            $table->string('eventname');
            $table->string('start_day');
            $table->string('end_day');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('city');
            $table->integer('user_id');
            $table->integer('number_of_seats');
            $table->text('description');
            $table->text('picture');
            $table->float('price');
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
        Schema::dropIfExists('users_events_posts');
    }
}
