<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConseilSportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conseil_sport', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('conseil_id')->unsigned();
            $table->integer('sport_id')->unsigned();

            $table->foreign('conseil_id')
                  ->references('id')
                  ->on('conseils')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('sport_id')
                  ->references('id')
                  ->on('sports')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

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
        Schema::table('conseil_sport', function(Blueprint $table) {
            $table->dropForeign('conseil_sport_conseil_id_foreign');
            $table->dropForeign('conseil_sport_sport_id_foreign');
        });
        Schema::drop('conseil_sport');
    }
}
