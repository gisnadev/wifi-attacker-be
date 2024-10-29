<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('bssid');
            $table->string('ssid');
	    $table->decimal('signal', $precision = 8, $scale = 2)->nullable();
	    $table->integer('channel');
	    $table->string('crypto')->nullable();
	    $table->enum('whitelisted', ['yes', 'no'])->default('no');
	    $table->enum('attackmode', ['suspect', 'eviltwin','karma','deauth','arp','normal'])->default('normal');
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
        Schema::dropIfExists('devices');
    }
}
