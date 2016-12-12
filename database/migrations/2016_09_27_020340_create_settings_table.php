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
            $table->text('incoming_fax')->nullable();
            $table->text('outgoing_fax')->nullable();
            $table->text('fax_status_change')->nullable();
            $table->text('unauthorized_access')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('entity_id')
//                ->references('id')->on('entities')
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
        Schema::dropIfExists('settings');
    }
}
