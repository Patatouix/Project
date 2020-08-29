<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConseilWeightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conseil_weight', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('conseil_id')->unsigned();
            $table->integer('weight_id')->unsigned();

            $table->foreign('conseil_id')
                  ->references('id')
                  ->on('conseils')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('weight_id')
                  ->references('id')
                  ->on('weights')
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
        Schema::table('conseil_weight', function(Blueprint $table) {
            $table->dropForeign('conseil_weight_conseil_id_foreign');
            $table->dropForeign('conseil_weight_weight_id_foreign');
        });
        Schema::drop('conseil_weight');
    }
}
