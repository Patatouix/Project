<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_food', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id')->unsigned();
            $table->integer('food_id')->unsigned();

            $table->foreign('food_id')
                  ->references('id')
                  ->on('foods')
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
        Schema::table('animal_food', function(Blueprint $table) {
            $table->dropForeign('animal_food_food_id_foreign');
            $table->dropForeign('animal_food_animal_id_foreign');
        });
        Schema::drop('animal_food');
    }
}
