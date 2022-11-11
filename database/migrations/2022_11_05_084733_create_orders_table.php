<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->float('total_price');
            $table->string('name','255');
            $table->string('email');
            $table->string('mobile','12');
            $table->string('phone')->nullable();
            $table->string('city');
            $table->mediumText('address');
            $table->string('pin_code');
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->string('tracking_no');
            $table->timestamp('ordered_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('orders');
    }
};
