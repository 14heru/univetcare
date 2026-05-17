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
        Schema::create('detail_billing', function (Blueprint $table) {
            $table->id();

            $table->foreignId('billing_id')
                ->constrained('billing')
                ->onDelete('cascade');

            $table->string('nama_item');

            $table->integer('qty')->default(1);

            $table->decimal('harga', 12, 2);

            $table->decimal('subtotal', 12, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_billing');
    }
};
