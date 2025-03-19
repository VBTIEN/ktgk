<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SinhVien;

class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SinhVien::create([
            'ma_sv' => '0123456789',
            'ho_ten' => 'Nguyễn Văn A',
            'gioi_tinh' => 'Nam',
            'ngay_sinh' => '2000-12-02',
            'hinh' => '/Content/images/sv1.jpg',
            'ma_nganh' => 'CNTT'
        ]);

        SinhVien::create([
            'ma_sv' => '9876543210',
            'ho_ten' => 'Nguyễn Thị B',
            'gioi_tinh' => 'Nữ',
            'ngay_sinh' => '2000-03-07',
            'hinh' => '/Content/images/sv2.jpg',
            'ma_nganh' => 'QTKD'
        ]);
    }
}
