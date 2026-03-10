<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lensa_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('foto');
            $table->date('tanggal');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lensa_kegiatan');
    }
};
