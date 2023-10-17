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
        Schema::create('rekap_absens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('tanggal');
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('checkin_id')
                ->nullable()
                ->constrained('absens')
                ->cascadeOnDelete();
            $table->foreignId('checkout_id')
                ->nullable()
                ->constrained('absens')
                ->cascadeOnDelete();
            $table->enum('shift', ['pagi', 'siang', 'malam'])->default('pagi');
            $table->string('catatan')->nullable();

            $table->unique(['user_id', 'tanggal']);
            $table->index(['user_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_absens');
    }
};
