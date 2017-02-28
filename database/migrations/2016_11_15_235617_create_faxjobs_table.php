<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaxjobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fax_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_id')->index;
            $table->string('comm_id')->nullable();
            $table->string('fax_id')->nullable()->index;
            $table->string('fax_from');
            $table->string('fax_to');
            $table->string('action');
            $table->string('status')->nullable();
            $table->string('status_description')->nullable();
            $table->datetime('sendtime')->nullable();
            $table->datetime('completetime')->nullable();
            $table->string('xmittime')->nullable();
            $table->integer('pagecount')->nullable();
            $table->integer('xmitpages')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fax_jobs');
    }
}
