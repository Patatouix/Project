<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalRaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_race', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id')->unsigned();
            $table->integer('race_id')->unsigned();

            $table->foreign('race_id')
                  ->references('id')
                  ->on('races')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('animal_id')
                  ->references('id')
                  ->on('animals')
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
        Schema::table('animal_race', function(Blueprint $table) {
            $table->dropForeign('animal_race_race_id_foreign');
            $table->dropForeign('animal_race_animal_id_foreign');
        });
        Schema::drop('animal_race');
    }
}
