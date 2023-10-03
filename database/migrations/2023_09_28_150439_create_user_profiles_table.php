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
        Schema::create('user_profiles', function (Blueprint $table) {
            Schema::create('user_profiles', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id'); // Foreign key to the users table
                $table->string('school')->nullable();
                $table->string('address')->nullable();
                $table->string('cell_number')->nullable();
                $table->string('office_number')->nullable();
                $table->string('email_address')->nullable();
                $table->string('good_time_to_call')->nullable();
                $table->string('twitter_account')->nullable();
                $table->string('facebook_page')->nullable();
                $table->string('school_mascot')->nullable();
                $table->string('coaches_photo')->nullable();
                $table->timestamps();

                // Define foreign key relationship to the users table
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
};
