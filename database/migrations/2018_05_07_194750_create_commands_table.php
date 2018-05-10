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
            $table->integer('id_user')->unsigned();
            $table->integer('id_article')->unsigned();

            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('id_article')
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
            $table->dropForeign('commands_id_user_foreign');
            $table->dropForeign('commands_id_article_foreign');
        });
        Schema::drop('commands');
    }
}
