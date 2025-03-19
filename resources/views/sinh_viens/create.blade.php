@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Thêm mới Sinh Viên
            </div>
            <div class="card-body">
                <form action="{{ route('sinh-viens.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="ma_sv">Mã SV</label>
                        <input type="text" name="ma_sv" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ho_ten">Họ Tên</label>
                        <input type="text" name="ho_ten" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gioi_tinh">Giới Tính</label>
                        <select name="gioi_tinh" class="form-control" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ngay_sinh">Ngày Sinh</label>
                        <input type="date" name="ngay_sinh" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="hinh">Hình</label>
                        <input type="file" name="hinh" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="ma_nganh">Ngành Học</label>
                        <select name="ma_nganh" class="form-control" required>
                            @foreach ($nganhHocs as $nganhHoc)
                                <option value="{{ $nganhHoc->ma_nganh }}">{{ $nganhHoc->ten_nganh }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <a href="{{ route('sinh-viens.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection