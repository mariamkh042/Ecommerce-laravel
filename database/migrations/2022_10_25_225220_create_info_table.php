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
        Schema::create('info', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('facebook');
            $table->text('instagram');
            $table->text('twitter');
            $table->text('youtube');
            $table->text('location');
            $table->text('open_hours');
            $table->timestamps();
        });

        DB::table('info')->insert(
            array(
                'id'=>1,
                'name' => 'name',
                'email'=>'info@example.com',
                'phone'=>'+1 5589 55488 55',
                'twitter'=>'#Link',
                'facebook'=>'#Link',
                'instagram'=>'#Link',
                'youtube'=>'#Link',
                'location'=>'Egypt Cairo',
                'open_hours'=>'Mon-Sat: 11AM - 23PM',
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info');
    }
};
