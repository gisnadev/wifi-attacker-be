<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeauthJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deauth_jobs', function (Blueprint $table) {
            $table->id();
            $table->text('target');
            $table->integer('channel');
            $table->enum('status', ['notstarted', 'started']);
            $table->smallInteger('pid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deauth_jobs');
    }
}
