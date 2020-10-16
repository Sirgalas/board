<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNetworkAuth extends Migration
{

    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();
        });
        Schema::create('user_networks',function (Blueprint $table){
            $table->integer('user_id')->references('id')->on('user')->onDelete('CASCADE');
            $table->string('network');
            $table->string('identity');
            $table->primary(['user_id','identity']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_networks');
        Schema::table('user',function (Blueprint $table){
            $table->string('email')->change();
            $table->string('password')->change();
        });
    }
}
