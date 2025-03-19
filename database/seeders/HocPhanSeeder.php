<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HocPhan;

class HocPhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HocPhan::create([
            'ma_hp' => 'CNTT01',
            'ten_hp' => 'Lập trình C',
            'so_tin_chi' => 3,
            'so_luong_du_kien' => 100,
        ]);

        HocPhan::create([
            'ma_hp' => 'CNTT02',
            'ten_hp' => 'Cơ sở dữ liệu',
            'so_tin_chi' => 2,
            'so_luong_du_kien' => 100,
        ]);

        HocPhan::create([
            'ma_hp' => 'QTKD01',
            'ten_hp' => 'Kinh tế vi mô',
            'so_tin_chi' => 2,
            'so_luong_du_kien' => 100,
        ]);

        HocPhan::create([
            'ma_hp' => 'QTDK02',
            'ten_hp' => 'Xác suất thống kê 1',
            'so_tin_chi' => 3,
            'so_luong_du_kien' => 100,
        ]);
    }
}
