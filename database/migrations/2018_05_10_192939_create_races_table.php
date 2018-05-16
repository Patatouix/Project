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
            $table->timestamps();
            $table->string('name', 255);
            $table->text('advice');
            $table->integer('species_id')->unsigned();
            $table->foreign('species_id')
                    ->references('id')
                    ->on('species')
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
        Schema::table('races', function(Blueprint $table) {
            $table->dropForeign('races_species_id_foreign');
        });
        Schema::drop('races');
    }
}
