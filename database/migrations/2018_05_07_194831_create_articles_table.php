<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 100);
            $table->float('price', 8, 2);
            $table->string('short_description', 255);
            $table->text('description');
            $table->text('image');
            $table->integer('id_tag')->unsigned();
            $table->foreign('id_tag')
                    ->references('id')
                    ->on('tags')
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
        Schema::table('articles', function(Blueprint $table) {
            $table->dropForeign('articles_id_tag_foreign');
        });
        Schema::drop('articles');
    }
}
