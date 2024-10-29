<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeauthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deauths', function (Blueprint $table) {
            $table->id();
            $table->string('addr1')->nullable();
	    $table->string('addr2')->nullable();
	    $table->string('addr3')->nullable();
	    $table->decimal('signal', $precision = 8, $scale = 2)->nullable();
            $table->string('flag')->nullable();
	    $table->integer('len')->nullable();
	    $table->integer('reason')->nullable();
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
        Schema::dropIfExists('deauths');
    }
}
