<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NganhHoc extends Model
{
    use HasFactory;

    protected $table = 'nganh_hocs';
    protected $primaryKey = 'ma_nganh';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['ma_nganh', 'ten_nganh'];

    public function sinhViens()
    {
        return $this->hasMany(SinhVien::class, 'ma_nganh', 'ma_nganh');
    }
}
