<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 100);
            $table->float('weight');
            $table->float('age');
            $table->boolean('sterilization')->default(false);
            $table->string('gender', 50);
            $table->text('image');
            $table->integer('user_id')->unsigned();
            $table->integer('species_id')->unsigned();
            $table->integer('environment_id')->unsigned();
            $table->integer('sport_id')->unsigned();
            $table->integer('food_id')->unsigned();
            $table->integer('race_id')->unsigned();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('user')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('species_id')
                  ->references('id')
                  ->on('species')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('environment_id')
                  ->references('id')
                  ->on('environments')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('sport_id')
                  ->references('id')
                  ->on('sports')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
                  
            $table->foreign('food_id')
                  ->references('id')
                  ->on('foods')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('race_id')
                  ->references('id')
                  ->on('races')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animals', function(Blueprint $table) {
            $table->dropForeign('animals_user_id_foreign');
            $table->dropForeign('animals_species_id_foreign');
            $table->dropForeign('animals_environment_id_foreign');
            $table->dropForeign('animals_sport_id_foreign');
            $table->dropForeign('animals_food_id_foreign');
            $table->dropForeign('animals_race_id_foreign');
        });
        Schema::drop('animals');
    }
}
