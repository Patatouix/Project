<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConseilsTable extends Migration
{
    public function up()
    {
        Schema::create('conseils', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('text');
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
        Schema::drop('conseils');
    }
}
