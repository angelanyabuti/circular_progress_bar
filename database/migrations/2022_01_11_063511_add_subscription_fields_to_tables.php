<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubscriptionFieldsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('plan_id')->nullable()->after('status');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->foreignId('plan_id')->nullable()->after('amount');
        });

        Schema::table('ipay_transactions', function (Blueprint $table) {
            $table->foreignId('invoice_id')->nullable()->after('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('plan_id');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('plan_id');
        });

        Schema::table('ipay_transactions', function (Blueprint $table) {
            $table->dropColumn('invoice_id');
        });
    }
}
