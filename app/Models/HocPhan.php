<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocPhan extends Model
{
    use HasFactory;

    protected $table = 'hoc_phans';
    protected $primaryKey = 'ma_hp';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['ma_hp', 'ten_hp', 'so_tin_chi', 'so_luong_du_kien'];

    public function chiTietDangKies()
    {
        return $this->hasMany(ChiTietDangKy::class, 'ma_hp', 'ma_hp');
    }
}
