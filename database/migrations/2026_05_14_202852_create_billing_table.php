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
        Schema::create('billing', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pemeriksaan_id')
                ->constrained('pemeriksaan')
                ->onDelete('cascade');

            $table->string('kode_billing')->unique();

            $table->decimal('subtotal', 12, 2)->default(0);

            $table->decimal('total', 12, 2)->default(0);

            $table->enum('status', [
                'Belum Dibayar',
                'Menunggu Verifikasi',
                'Lunas'
            ])->default('Belum Dibayar');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing');
    }
};
