<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NganhHoc;

class NganhHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NganhHoc::create([
            'ma_nganh' => 'CNTT',
            'ten_nganh' => 'Công nghệ thông tin'
        ]);

        NganhHoc::create([
            'ma_nganh' => 'QTKD',
            'ten_nganh' => 'Quản trị kinh doanh'
        ]);
    }
}
