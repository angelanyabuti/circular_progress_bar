<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table ->boolean('active')->default(true);
            $table ->decimal('rate')->default(5);
            $table ->decimal('base_price')->default(20);
            $table ->string('longitude')->nullable();
            $table ->string('latitude')->nullable(20);
            $table ->string('address')->nullable(20);
            $table->longText('bio')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('agents');
    }
}
