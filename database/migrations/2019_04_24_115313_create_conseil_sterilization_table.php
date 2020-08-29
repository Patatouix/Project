<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConseilSterilizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conseil_sterilization', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('conseil_id')->unsigned();
            $table->integer('sterilization_id')->unsigned();

            $table->foreign('conseil_id')
                  ->references('id')
                  ->on('conseils')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('sterilization_id')
                  ->references('id')
                  ->on('sterilizations')
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
        Schema::table('conseil_sterilization', function(Blueprint $table) {
            $table->dropForeign('conseil_sterilization_conseil_id_foreign');
            $table->dropForeign('conseil_sterilization_sterilization_id_foreign');
        });
        Schema::drop('conseil_sterilization');
    }
}
