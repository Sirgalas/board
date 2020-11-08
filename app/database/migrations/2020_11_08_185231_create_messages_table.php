<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->text('message');
        });

        Schema::table('advert_dialogs',function(Blueprint $table){
            $table->string('message_id')->references('id')->on('advert_messages')->onDelete('CASCADE')->onUpdate('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
