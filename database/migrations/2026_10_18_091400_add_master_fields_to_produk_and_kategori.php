<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('produk', 'nama_produk')) {
            Schema::table('produk', fn (Blueprint $table) => $table->string('nama_produk')->default(''));
        }

        if (! Schema::hasColumn('produk', 'harga')) {
            Schema::table('produk', fn (Blueprint $table) => $table->decimal('harga', 12, 2)->default(0));
        }

        if (! Schema::hasColumn('produk', 'stok')) {
            Schema::table('produk', fn (Blueprint $table) => $table->unsignedInteger('stok')->default(0));
        }

        if (! Schema::hasColumn('produk', 'deskripsi')) {
            Schema::table('produk', fn (Blueprint $table) => $table->text('deskripsi')->nullable());
        }

        if (! Schema::hasColumn('kategori', 'nama_kategori')) {
            Schema::table('kategori', fn (Blueprint $table) => $table->string('nama_kategori')->default(''));
        }

        if (! Schema::hasColumn('kategori', 'keterangan')) {
            Schema::table('kategori', fn (Blueprint $table) => $table->text('keterangan')->nullable());
        }
    }

    public function down(): void
    {
        // The create-table migrations also define these fields; retaining them keeps both schema histories valid.
    }
};
