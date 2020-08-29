<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->float('price', 8, 2);
            $table->string('short_description', 255);
            $table->text('description');
            $table->integer('image_id')->unsigned()->default(0);

            $table->foreign('image_id')
                    ->references('id')
                    ->on('images')
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
        Schema::table('produits', function(Blueprint $table) {
            $table->dropForeign('produits_image_id_foreign');
        });
        Schema::drop('produits');
    }
}
