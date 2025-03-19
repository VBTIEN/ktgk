<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangKy extends Model
{
    use HasFactory;

    protected $table = 'dang_kies';
    protected $primaryKey = 'ma_dk';

    protected $fillable = ['ngay_dk', 'ma_sv'];

    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'ma_sv', 'ma_sv');
    }

    public function chiTietDangKies()
    {
        return $this->hasMany(ChiTietDangKy::class, 'ma_dk', 'ma_dk');
    }
}
