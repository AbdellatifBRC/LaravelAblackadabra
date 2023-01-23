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
        Schema::create('order_simples', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('fullname');
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->decimal('grand_total', 32, 2)->default(0)->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->integer('postcode')->nullable();
            $table->string('shippingService')->nullable();
            $table->text('notes')->nullable();
            // $table->index('payment_token');
            // $table->index('code');
            // $table->index(['code', 'order_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_simples');
    }
};
