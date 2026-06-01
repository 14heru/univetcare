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
        Schema::table('pembayaran', function (Blueprint $table) {

            // tambah pemesanan_id
            $table->unsignedBigInteger('pemesanan_id')
                  ->nullable()
                  ->after('id');

            // billing_id jadi nullable
            $table->unsignedBigInteger('billing_id')
                  ->nullable()
                  ->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {

            $table->dropColumn('pemesanan_id');

        });
    }
};