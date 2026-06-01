<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {

            if (!Schema::hasColumn('pembayaran', 'jenis_pembayaran')) {

                $table->enum(
                    'jenis_pembayaran',
                    ['DP', 'Lunas']
                )->default('DP');

            }

            if (!Schema::hasColumn('pembayaran', 'bukti_pembayaran')) {

                $table->string('bukti_pembayaran')
                      ->nullable();

            }

            if (!Schema::hasColumn('pembayaran', 'qr_code')) {

                $table->string('qr_code')
                      ->nullable();

            }

            if (!Schema::hasColumn('pembayaran', 'expired_at')) {

                $table->timestamp('expired_at')
                      ->nullable();

            }

        });
    }

    public function down(): void
    {
        //
    }
};
