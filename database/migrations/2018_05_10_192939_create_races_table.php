<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->integer('espece_id')->unsigned();

            $table->foreign('espece_id')
                    ->references('id')
                    ->on('especes')
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
        Schema::table('races', function(Blueprint $table) {
            $table->dropForeign('races_espece_id_foreign');
        });
        Schema::drop('races');
    }
}
