<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tchats', function (Blueprint $table) {

            $table->increments('id');
            $table->string('subject');
            $table->mediumText('bodys');
            $table->timestamps();
        });


        Schema::create('tchats_Users', function (Blueprint $table) {

            $table->integer('user_id')->unsigned();
            $table->integer('tchat_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tchat_id')->references('id')->on('tchats')->onDelete('cascade');
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
        Schema::dropIfExists('tchats');
    }
}
