<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReceiveConfirmationToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('order_received')->default(false)->after('address');
            $table->string('receive_confirm_code')->nullable()->after('order_received');
            $table->string('order_received_confirmed_at')->nullable()->after('receive_confirm_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['order_received','receive_confirm_code','order_received_confirmed_at']);
        });
    }
}
