<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('publikasi_dokumen', function (Blueprint $table) {
            $table->unsignedBigInteger('downloads')->default(0)->after('aktif');
            $table->unsignedBigInteger('shares')->default(0)->after('downloads');
        });
    }

    public function down(): void
    {
        Schema::table('publikasi_dokumen', function (Blueprint $table) {
            $table->dropColumn(['downloads', 'shares']);
        });
    }
};
