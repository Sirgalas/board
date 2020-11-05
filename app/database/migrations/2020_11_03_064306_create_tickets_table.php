<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->string('subject');
            $table->text('content');
            $table->string('status',16);
            $table->timestamps();
        });

        Schema::create('ticket_statuses',function (Blueprint $table){
            $table->id();
            $table->integer('ticket_id')->references('id')->on('ticket_ticket')->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->string('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->string('status',10);
            $table->timestamps();
        });

        Schema::create('ticket_messages',function (Blueprint $table){
            $table->id();
            $table->integer('ticket_id')->references('id')->on('ticket_ticket')->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->string('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->text('message');
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
        Schema::dropIfExists('ticket_messages');
        Schema::dropIfExists('ticket_statuses');
        Schema::dropIfExists('ticket_tickets');
    }
}
