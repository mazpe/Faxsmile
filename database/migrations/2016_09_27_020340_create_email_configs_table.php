<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('provider_id')->unsigned();
            $table->string('from_email')->nullable();
            $table->string('from_name')->nullable();
            $table->string('signature')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('company_id')
//                ->references('id')->on('companies')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//            $table->foreign('provider_id')
//                ->references('id')->on('providers')
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
        Schema::dropIfExists('email_configs');
    }
}
