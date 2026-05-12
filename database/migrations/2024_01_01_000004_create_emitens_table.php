<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emitens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sector_id')->constrained()->onDelete('cascade');
            $table->string('kode', 10)->unique();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->integer('harga')->default(0);
            $table->decimal('market_cap', 15, 2)->default(0); // in Triliun Rupiah
            $table->decimal('npm', 8, 2)->default(0); // Net Profit Margin %
            $table->decimal('per', 8, 2)->default(0); // Price to Earning Ratio
            $table->decimal('pbv', 8, 2)->default(0); // Price to Book Value
            $table->decimal('der', 8, 2)->default(0); // Debt to Equity Ratio
            $table->decimal('roe', 8, 2)->default(0); // Return on Equity %
            $table->decimal('roa', 8, 2)->default(0); // Return on Asset %
            $table->decimal('dividend_yield', 8, 2)->default(0); // %
            $table->decimal('ytd_return', 8, 2)->default(0); // Year to Date %
            $table->decimal('one_year_return', 8, 2)->default(0); // 1 Year %
            $table->decimal('three_year_return', 8, 2)->default(0); // 3 Year %
            $table->decimal('volume', 15, 0)->default(0); // daily avg volume
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emitens');
    }
};
