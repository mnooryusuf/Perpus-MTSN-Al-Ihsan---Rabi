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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->date('tanggal_pinjam')->nullable()->change();
            $table->date('tanggal_kembali')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->date('tanggal_pinjam')->nullable(false)->change();
            $table->date('tanggal_kembali')->nullable(false)->change();
        });
    }
};
