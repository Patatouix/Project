<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConseilFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conseil_food', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('conseil_id')->unsigned();
            $table->integer('food_id')->unsigned();

            $table->foreign('conseil_id')
                  ->references('id')
                  ->on('conseils')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('food_id')
                  ->references('id')
                  ->on('foods')
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
        Schema::table('conseil_food', function(Blueprint $table) {
            $table->dropForeign('conseil_food_conseil_id_foreign');
            $table->dropForeign('conseil_food_food_id_foreign');
        });
        Schema::drop('conseil_food');
    }
}
