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
            $table->integer('entity_id')->unsigned();
            $table->integer('fax_id')->nullable()->unsigned();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('recipient')->nullable();
            $table->string('sender')->nullable();
            $table->text('note')->nullable();
            $table->integer('active')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('entity_id')
                ->references('id')->on('entities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('fax_id')
                ->references('id')->on('faxes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
