<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paket_category', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_product_id');
            $table->string('name');
            $table->bigInteger('stock')->nullable();
            $table->bigInteger('price');
            $table->bigInteger('profit_margin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_category');
    }
};
