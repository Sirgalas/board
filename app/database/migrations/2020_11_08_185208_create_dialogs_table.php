<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDialogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_dialogs', function (Blueprint $table) {
            $table->id();
            $table->string('advert_id')->references('id')->on('advert_adverts')->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->string('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->string('client_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('RESTRICT');
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
        Schema::dropIfExists('advert_dialogs');
    }
}
