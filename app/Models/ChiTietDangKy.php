<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDangKy extends Model
{
    use HasFactory;

    protected $table = 'chi_tiet_dang_kies';
    public $incrementing = false;

    protected $primaryKey = ['ma_dk', 'ma_hp'];

    protected $fillable = ['ma_dk', 'ma_hp'];

    public function dangKy()
    {
        return $this->belongsTo(DangKy::class, 'ma_dk', 'ma_dk');
    }

    public function hocPhan()
    {
        return $this->belongsTo(HocPhan::class, 'ma_hp', 'ma_hp');
    }
}
