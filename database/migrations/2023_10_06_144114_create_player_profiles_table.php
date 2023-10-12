<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'); // Player ka ID.
            $table->string('profile_picture')->nullable();
            $table->text('video_embed')->nullable();
            $table->text('introduction')->nullable();
            $table->float('forty_times')->nullable();
            $table->float('vertical_jump')->nullable();
            $table->float('gpa')->nullable();
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
        Schema::dropIfExists('player_profiles');
    }
};
