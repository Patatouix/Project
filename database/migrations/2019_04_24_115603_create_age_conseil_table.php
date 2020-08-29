<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgeConseilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_conseil', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('age_id')->unsigned();
            $table->integer('conseil_id')->unsigned();

            $table->foreign('age_id')
                  ->references('id')
                  ->on('ages')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('conseil_id')
                  ->references('id')
                  ->on('conseils')
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
        Schema::table('age_conseil', function(Blueprint $table) {
            $table->dropForeign('age_conseil_age_id_foreign');
            $table->dropForeign('age_conseil_conseil_id_foreign');
        });
        Schema::drop('age_conseil');
    }
}
