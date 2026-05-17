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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('billing_id')
                    ->constrained('billing')
                    ->onDelete('cascade');

            $table->string('kode_pembayaran')->unique();

            $table->enum('metode_pembayaran', [
                'QRIS',
                'Transfer',
                'Cash',
                'E-Wallet'
            ]);

            $table->string('bukti_pembayaran')->nullable();

            $table->decimal('jumlah_bayar', 12,2);

            $table->enum('status', [
                'Belum Dibayar',
                'Menunggu Verifikasi',
                'Lunas',
                'Gagal'
            ])->default('Belum Dibayar');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
