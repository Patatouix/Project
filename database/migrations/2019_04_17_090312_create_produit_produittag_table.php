<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitProduittagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_produittag', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('produit_id')->unsigned();
            $table->integer('produittag_id')->unsigned();

            $table->foreign('produit_id')
                  ->references('id')
                  ->on('produits')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('produittag_id')
                  ->references('id')
                  ->on('produittags')
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
        Schema::table('produit_produittag', function(Blueprint $table) {
            $table->dropForeign('produit_produittag_produit_id_foreign');
            $table->dropForeign('produit_produittag_produittag_id_foreign');
        });
        Schema::drop('produit_produittag');
    }
}
