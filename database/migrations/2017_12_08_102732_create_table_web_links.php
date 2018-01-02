<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWebLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('link');
            $table->integer('sort');
            $table->integer('type');
            $table->string('image')->default("");
            $table->string('file_name')->default("");
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
        //
        Schema::dropIfExists('web_links');
    }
}
