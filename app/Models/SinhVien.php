<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'sinh_viens';
    protected $primaryKey = 'ma_sv';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['ma_sv', 'ho_ten', 'gioi_tinh', 'ngay_sinh', 'hinh', 'ma_nganh'];

    public function nganhHoc()
    {
        return $this->belongsTo(NganhHoc::class, 'ma_nganh', 'ma_nganh');
    }

    public function dangKies()
    {
        return $this->hasMany(DangKy::class, 'ma_sv', 'ma_sv');
    }
}
