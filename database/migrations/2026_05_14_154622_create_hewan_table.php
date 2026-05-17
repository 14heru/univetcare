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
        Schema::create('hewan', function (Blueprint $table) {
            $table->id();

            $table ->foreignId('user_id')
                    ->constrained()
                    ->onDelete('cascade');
            $table->string('nama_hewan');
            $table->string('jenis_hewan');
            $table->string('ras')->nullable();

            $table->enum('jenis_kelamin',[
                'Jantan',
                'Betina',
            ]);

            $table->string('umur')->nullable();
            $table->decimal('berat', 5,2)->nullable();
            $table->string('warna')->nullable();

            $table->text('keluhan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hewan');
    }
};
