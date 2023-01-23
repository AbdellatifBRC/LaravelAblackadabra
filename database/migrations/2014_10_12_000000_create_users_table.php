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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_subscriber')->default(false);
            $table->text('address')->nullable();
            $table->text('address2')->nullable();
            $table->string('province_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('user_picture')->nullable();
            $table->string('user_gender')->nullable();
            $table->string('user_category')->nullable();
            $table->string('user_company')->nullable();
            $table->string('user_job')->nullable();
            $table->string('user_youtube')->nullable();
            $table->string('user_tiktok')->nullable();
            $table->string('user_facebook')->nullable();
            $table->string('user_instagram')->nullable();
            $table->string('user_linkedin')->nullable();
            $table->string('user_twitter')->nullable();
            $table->text('user_relations')->nullable();
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
};
