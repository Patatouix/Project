<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_reservation', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('produit_id')->unsigned();
            $table->integer('reservation_id')->unsigned();

            $table->foreign('produit_id')
                  ->references('id')
                  ->on('produits')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('reservation_id')
                  ->references('id')
                  ->on('reservations')
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
        Schema::table('produit_reservation', function(Blueprint $table) {
            $table->dropForeign('produit_reservation_produit_id_foreign');
            $table->dropForeign('produit_reservation_reservation_id_foreign');
        });
        Schema::drop('produit_reservation');
    }
}
