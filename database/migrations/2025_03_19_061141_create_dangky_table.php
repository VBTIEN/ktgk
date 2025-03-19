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
        Schema::create('dang_kies', function (Blueprint $table) {
            $table->id('ma_dk');
            $table->date('ngay_dk')->nullable();
            $table->char('ma_sv', 10);
            $table->foreign('ma_sv')->references('ma_sv')->on('sinh_viens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dang_kies');
    }
};
