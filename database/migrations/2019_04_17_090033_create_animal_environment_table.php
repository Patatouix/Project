<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalEnvironmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_environment', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id')->unsigned();
            $table->integer('environment_id')->unsigned();

            $table->foreign('environment_id')
                  ->references('id')
                  ->on('environments')
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
        Schema::table('animal_environment', function(Blueprint $table) {
            $table->dropForeign('animal_environment_environment_id_foreign');
            $table->dropForeign('animal_environment_animal_id_foreign');
        });
        Schema::drop('animal_environment');
    }
}
