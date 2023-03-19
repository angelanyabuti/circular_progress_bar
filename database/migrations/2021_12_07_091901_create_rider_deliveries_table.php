<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiderDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_deliveries', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('rider_id')->nullable();
            $table -> unsignedBigInteger('order_id')->nullable();
            $table -> string('status')->nullable();
            $table ->timestamp('delivered_at')->nullable();
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
        Schema::dropIfExists('rider_deliveries');
    }
}
