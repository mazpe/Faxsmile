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
        Schema::create('faxjobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jobid')->index;
            $table->string('fax_id')->index;
            $table->string('fax_number');
            $table->string('action');
            $table->string('status');
            $table->datetime('timestamp');
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
        Schema::dropIfExists('faxjobs');
    }
}
