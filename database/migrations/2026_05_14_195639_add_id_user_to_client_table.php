<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('client', function (Blueprint $table) {
            // Menambahkan kolom id_user setelah kolom id
            $table->unsignedBigInteger('id_user')->nullable()->after('id');
            
            // Opsional: Membuat relasi foreign key
            // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('client', function (Blueprint $table) {
            $table->dropColumn('id_user');
        });
    }
};