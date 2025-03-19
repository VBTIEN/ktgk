@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sửa Sinh Viên</h1>
        <form action="{{ route('sinh-viens.update', $sinhVien->ma_sv) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="ma_sv">Mã SV</label>
                <input type="text" name="ma_sv" class="form-control" value="{{ $sinhVien->ma_sv }}" readonly>
            </div>
            <div class="form-group">
                <label for="ho_ten">Họ Tên</label>
                <input type="text" name="ho_ten" class="form-control" value="{{ $sinhVien->ho_ten }}" required>
            </div>
            <div class="form-group">
                <label for="gioi_tinh">Giới Tính</label>
                <select name="gioi_tinh" class="form-control" required>
                    <option value="Nam" {{ $sinhVien->gioi_tinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                    <option value="Nữ" {{ $sinhVien->gioi_tinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ngay_sinh">Ngày Sinh</label>
                <input type="date" name="ngay_sinh" class="form-control" value="{{ $sinhVien->ngay_sinh }}" required>
            </div>
            <div class="form-group">
                <label for="hinh">Hình</label>
                <input type="file" name="hinh" class="form-control">
                @if ($sinhVien->hinh)
                    <img src="{{ asset($sinhVien->hinh) }}" alt="Hình hiện tại" width="100">
                @endif
            </div>
            <div class="form-group">
                <label for="ma_nganh">Ngành Học</label>
                <select name="ma_nganh" class="form-control" required>
                    @foreach ($nganhHocs as $nganhHoc)
                        <option value="{{ $nganhHoc->ma_nganh }}" {{ $sinhVien->ma_nganh == $nganhHoc->ma_nganh ? 'selected' : '' }}>
                            {{ $nganhHoc->ten_nganh }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('sinh-viens.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection