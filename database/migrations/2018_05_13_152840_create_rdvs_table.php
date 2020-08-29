<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRdvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rdvs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('request', 255);
            $table->string('response', 255)->default('Pas de réponse de la clinique pour le moment');
            $table->string('status', 100)->default('En attente');
            $table->integer('user_id')->unsigned();
            $table->integer('vet_id')->unsigned();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('vet_id')
                  ->references('id')
                  ->on('vets')
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
        Schema::table('rdvs', function(Blueprint $table) {
            $table->dropForeign('rdvs_user_id_foreign');
            $table->dropForeign('rdvs_vet_id_foreign');
        });
        Schema::drop('rdvs');
    }
}
