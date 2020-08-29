<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalRdvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_rdv', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id')->unsigned();
            $table->integer('rdv_id')->unsigned();

            $table->foreign('rdv_id')
                  ->references('id')
                  ->on('rdvs')
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
        Schema::table('animal_rdv', function(Blueprint $table) {
            $table->dropForeign('animal_rdv_animal_id_foreign');
            $table->dropForeign('animal_rdv_rdv_id_foreign');
        });
        Schema::drop('animal_rdv');
    }
}
