<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\PublikasiDokumen;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('publikasi_dokumen', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('judul');
        });

        // Generate slug untuk data yang sudah ada
        foreach (PublikasiDokumen::all() as $item) {
            $item->slug = Str::slug($item->judul) . '-' . $item->tahun;
            $item->save();
        }
    }

    public function down(): void
    {
        Schema::table('publikasi_dokumen', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
