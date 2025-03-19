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
        Schema::create('chi_tiet_dang_kies', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_dk');
            $table->char('ma_hp', 6);
            $table->foreign('ma_dk')->references('ma_dk')->on('dang_kies')->onDelete('cascade');
            $table->foreign('ma_hp')->references('ma_hp')->on('hoc_phans')->onDelete('cascade');
            $table->primary(['ma_dk', 'ma_hp']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_dang_kies');
    }
};
