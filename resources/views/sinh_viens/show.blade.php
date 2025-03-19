@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Chi tiết Sinh Viên
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if ($sinhVien->hinh)
                            <img src="{{ asset($sinhVien->hinh) }}" alt="Hình" class="img-fluid rounded-circle mb-3" style="width: 150px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                        @else
                            <div class="text-muted mb-3">Không có hình</div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <p><strong>Mã SV:</strong> {{ $sinhVien->ma_sv }}</p>
                        <p><strong>Họ Tên:</strong> {{ $sinhVien->ho_ten }}</p>
                        <p><strong>Giới Tính:</strong> {{ $sinhVien->gioi_tinh }}</p>
                        <p><strong>Ngày Sinh:</strong> {{ $sinhVien->ngay_sinh }}</p>
                        <p><strong>Ngành Học:</strong> {{ $sinhVien->nganhHoc->ten_nganh }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('sinh-viens.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@endsection