<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('slug')->nullable();
            $table->enum('type',['instore', 'online','product'])->default('instore');
            $table->integer('delivery_time')->default(1);
            $table->boolean('active')->default(false);
            $table->boolean('physical')->default(true);
            $table->foreignId('product_category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('shop_id')->nullable()->constrained()->cascadeOnDelete();
            $table->boolean('flat_rate')->default(false);
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 16, 2)->default(0);
            $table->decimal('mock_price', 16, 2)->default(0);
            $table->decimal('cost', 16, 2)->default(0);
            $table->jsonb('options')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
