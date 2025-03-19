@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách Sinh Viên</h1>
        <a href="{{ route('sinh-viens.create') }}" class="btn btn-primary mb-3">Thêm mới</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình</th>
                    <th>Ngành Học</th>
                    <th>Đăng Ký</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sinhViens as $sinhVien)
                    <tr>
                        <td>{{ $sinhVien->ma_sv }}</td>
                        <td>{{ $sinhVien->ho_ten }}</td>
                        <td>{{ $sinhVien->gioi_tinh }}</td>
                        <td>{{ $sinhVien->ngay_sinh }}</td>
                        <td><img src="{{ asset($sinhVien->hinh) }}" alt="Hình" width="50"></td>
                        <td>{{ $sinhVien->nganhHoc->ten_nganh }}</td>
                        <td>
                            <a href="{{ route('dang-ky.create', $sinhVien->ma_sv) }}" class="btn btn-success btn-sm">Đăng Ký</a>
                            <a href="{{ route('dang-ky.danh-sach', $sinhVien->ma_sv) }}" class="btn btn-info btn-sm">Xem Đăng Ký</a>
                        </td>
                        <td>
                            <a href="{{ route('sinh-viens.show', $sinhVien->ma_sv) }}" class="btn btn-info btn-sm">Xem</a>
                            <a href="{{ route('sinh-viens.edit', $sinhVien->ma_sv) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('sinh-viens.destroy', $sinhVien->ma_sv) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $sinhViens->links() }}
    </div>
@endsection