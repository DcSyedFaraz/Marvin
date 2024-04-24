<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        // Colleges table
        Schema::create('colleges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('photo')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->text('location')->nullable();
            $table->string('type')->nullable();
            $table->string('website')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->timestamps();
        });



        // Sports table
        Schema::create('sports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });

         // CoachSport table
         Schema::create('coach_sport', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('colleges_id')->nullable();
            $table->unsignedBigInteger('sports_id')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('colleges_id')->references('id')->on('colleges')->onDelete('cascade');
            $table->foreign('sports_id')->references('id')->on('sports')->onDelete('cascade');
        });

         // Coaches table
         Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('colleges_id')->nullable();
            $table->unsignedBigInteger('sports_id')->nullable();
            $table->unsignedBigInteger('coach_sport_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('bio')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('colleges_id')->references('id')->on('colleges')->onDelete('cascade');
            $table->foreign('sports_id')->references('id')->on('sports')->onDelete('cascade');
            $table->foreign('coach_sport_id')->references('id')->on('coach_sport')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('colleges');
        Schema::dropIfExists('sports');
        Schema::dropIfExists('coach_sport');
        Schema::dropIfExists('coaches');
    }
};
