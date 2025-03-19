@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Thêm mới Sinh Viên</h1>
        <form action="{{ route('sinh-viens.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ma_sv">Mã SV</label>
                <input type="text" name="ma_sv" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="ho_ten">Họ Tên</label>
                <input type="text" name="ho_ten" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gioi_tinh">Giới Tính</label>
                <select name="gioi_tinh" class="form-control" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ngay_sinh">Ngày Sinh</label>
                <input type="date" name="ngay_sinh" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="hinh">Hình</label>
                <input type="file" name="hinh" class="form-control">
            </div>
            <div class="form-group">
                <label for="ma_nganh">Ngành Học</label>
                <select name="ma_nganh" class="form-control" required>
                    @foreach ($nganhHocs as $nganhHoc)
                        <option value="{{ $nganhHoc->ma_nganh }}">{{ $nganhHoc->ten_nganh }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('sinh-viens.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection