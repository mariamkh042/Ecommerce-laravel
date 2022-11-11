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
            $table->foreignId('category_id');
            $table->string('name');
            $table->string('slug','191');
            $table->string('small_description','255')->nullable();
            $table->longText('description');
            $table->float('original_price');
            $table->float('selling_price');
            $table->string('image');
            $table->float('offer')->nullable();
            $table->float('tax')->nullable();
            $table->float('total_price');
            $table->tinyInteger('status');
            $table->tinyInteger('trending');
            $table->string('meta_title','255')->nullable();
            $table->mediumText('meta_keywords')->nullable();
            $table->mediumText('meta_description')->nullable();
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
