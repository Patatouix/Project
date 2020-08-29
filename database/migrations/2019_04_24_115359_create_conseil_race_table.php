<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConseilRaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conseil_race', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('conseil_id')->unsigned();
            $table->integer('race_id')->unsigned();

            $table->foreign('conseil_id')
                  ->references('id')
                  ->on('conseils')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('race_id')
                  ->references('id')
                  ->on('races')
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
        Schema::table('conseil_race', function(Blueprint $table) {
            $table->dropForeign('conseil_race_conseil_id_foreign');
            $table->dropForeign('conseil_race_race_id_foreign');
        });
        Schema::drop('conseil_race');
    }
}
