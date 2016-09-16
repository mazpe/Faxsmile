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
            $table->integer('client_id')->unsigned();
            $table->integer('fax_id')->nullable()->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('recipient');
            $table->string('sender');
            $table->integer('active')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('client_id')
                ->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
//
//            $table->foreign('fax_id')
//                ->references('id')->on('faxes')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
