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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->integer('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('description')->nullable();
            $table->text('details')->nullable();
            $table->decimal('weight')->nullable();
            $table->string('size')->nullable();
            $table->boolean('is_promo')->default(false);
            $table->boolean('is_new')->default(false);
            $table->integer('prixbare')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('products');
    }
};
