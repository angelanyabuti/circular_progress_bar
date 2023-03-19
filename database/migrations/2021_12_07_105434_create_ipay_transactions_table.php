<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpayTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipay_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('txn_code')->nullable();
            $table->string('registered_name')->nullable();
            $table->string('registered_number')->nullable();
            $table->string('channel')->nullable();
            $table->foreignId('order_id')->nullable()->references('id')->on('orders')->nullOnDelete();
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
        Schema::dropIfExists('ipay_transactions');
    }
}
