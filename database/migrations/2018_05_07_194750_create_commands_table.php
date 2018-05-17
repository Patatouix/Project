<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commands', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('takeout', 255)->default('Non renseigné');
            $table->string('status', 255)->default('En attente de validation');
            $table->integer('user_id')->unsigned();
            $table->integer('article_id')->unsigned();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('article_id')
                  ->references('id')
                  ->on('articles')
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
        Schema::table('commands', function(Blueprint $table) {
            $table->dropForeign('commands_user_id_foreign');
            $table->dropForeign('commands_article_id_foreign');
        });
        Schema::drop('commands');
    }
}
