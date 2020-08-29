<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('prenom', 60);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->boolean('admin')->default(false);
            $table->string('phone', 50)->default('Non communiqué');
            $table->string('adress', 255)->default('Non communiqué');
            $table->integer('image_id')->unsigned()->default(0);

            $table->foreign('image_id')
                    ->references('id')
                    ->on('images')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');

            $table->rememberToken();
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
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_image_id_foreign');
        });
        Schema::dropIfExists('users');
    }
}
