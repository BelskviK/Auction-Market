<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lot_bid_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lot_id')->constrained();
            $table->unsignedDecimal('bid_amount');
            $table->string('bidder_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lot_bid_logs');
    }
};
