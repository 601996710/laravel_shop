<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWebImagesPsition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_images_position', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_images_id');
            $table->string('name');
            $table->text('link');
            $table->integer('sort');
            $table->string('image');
            $table->string('file_name');
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

        Schema::dropIfExists('web_images_position');
    }
}
