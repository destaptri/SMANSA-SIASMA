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
        Schema::create('validasi_biodata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('biodata_id')->constrained('pengajuan_biodata')->onDelete('cascade'); // FK ke pengajuan_biodata
            $table->foreignId('verifikator')->constrained('users')->onDelete('cascade'); // FK ke users (admin yang memverifikasi)
            $table->enum('status', ['ya', 'tidak'])->default('tidak');
            $table->timestamp('tanggal_verifikasi')->useCurrent();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi_biodata');
    }
};
