<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaxRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fax_recipients', function (Blueprint $table) {
            $table->integer('fax_id')->unsigned();
            $table->integer('recipient_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('fax_id')
                ->references('id')->on('faxes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('recipient_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('fax_recipients');
    }
}
