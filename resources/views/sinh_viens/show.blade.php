@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Chi tiết Sinh Viên</h1>
        <div class="card">
            <div class="card-body">
                <p><strong>Mã SV:</strong> {{ $sinhVien->ma_sv }}</p>
                <p><strong>Họ Tên:</strong> {{ $sinhVien->ho_ten }}</p>
                <p><strong>Giới Tính:</strong> {{ $sinhVien->gioi_tinh }}</p>
                <p><strong>Ngày Sinh:</strong> {{ $sinhVien->ngay_sinh }}</p>
                <p><strong>Hình:</strong> 
                    @if ($sinhVien->hinh)
                        <img src="{{ asset($sinhVien->hinh) }}" alt="Hình" width="100">
                    @else
                        Không có hình
                    @endif
                </p>
                <p><strong>Ngành Học:</strong> {{ $sinhVien->nganhHoc->ten_nganh }}</p>
                <a href="{{ route('sinh-viens.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    </div>
@endsection