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
        Schema::create('sinh_viens', function (Blueprint $table) {
            $table->char('ma_sv', 10)->primary();
            $table->string('ho_ten', 50);
            $table->string('gioi_tinh', 5)->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->string('hinh', 50)->nullable();
            $table->char('ma_nganh', 4);
            $table->foreign('ma_nganh')->references('ma_nganh')->on('nganh_hocs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinh_viens');
    }
};
