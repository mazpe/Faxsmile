<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id')->unsigned();
            $table->string('from_email');
            $table->string('from_name')->nullable();
            $table->string('signature')->nullable();
            $table->string('fax_incoming_subject')->nullable();
            $table->text('fax_incoming')->nullable();
            $table->string('fax_outgoing_subject')->nullable();
            $table->text('fax_outgoing')->nullable();
            $table->string('fax_status_subject')->nullable();
            $table->text('fax_status')->nullable();
            $table->string('unauthorized_access_subject')->nullable();
            $table->text('unauthorized_access')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('entity_id')
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
        Schema::dropIfExists('settings');
    }
}
