<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('image_id')->unsigned()->default(0);
            $table->integer('user_id')->unsigned();
            $table->integer('espece_id')->unsigned();
            $table->integer('sport_id')->unsigned();
            $table->integer('age_id')->unsigned();
            $table->integer('gender_id')->unsigned();
            $table->integer('weight_id')->unsigned();
            $table->integer('sterilization_id')->unsigned();

            $table->foreign('image_id')
                  ->references('id')
                  ->on('images')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('espece_id')
                  ->references('id')
                  ->on('especes')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('sport_id')
                  ->references('id')
                  ->on('sports')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('age_id')
                  ->references('id')
                  ->on('ages')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('gender_id')
                  ->references('id')
                  ->on('genders')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('weight_id')
                  ->references('id')
                  ->on('weights')
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
        Schema::table('animals', function(Blueprint $table) {
            $table->dropForeign('animals_image_id_foreign');
            $table->dropForeign('animals_user_id_foreign');
            $table->dropForeign('animals_espece_id_foreign');
            $table->dropForeign('animals_sport_id_foreign');
            $table->dropForeign('animals_age_id_foreign');
            $table->dropForeign('animals_gender_id_foreign');
            $table->dropForeign('animals_weight_id_foreign');
            $table->dropForeign('animals_sterilization_id_foreign');
        });
        Schema::drop('animals');
    }
}
