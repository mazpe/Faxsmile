<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->unsigned();
            $table->integer('client_id')->nullable()->unsigned();
            $table->string('number');
            $table->string('description');
            $table->text('note')->nullable();
            $table->integer('active')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('provider_id')
                ->references('id')->on('entities')
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
        Schema::dropIfExists('faxes');
    }
}
