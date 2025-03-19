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
        Schema::create('hoc_phans', function (Blueprint $table) {
            $table->char('ma_hp', 6)->primary();
            $table->string('ten_hp', 30);
            $table->integer('so_tin_chi');
            $table->integer('so_luong_du_kien')->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoc_phans');
    }
};
