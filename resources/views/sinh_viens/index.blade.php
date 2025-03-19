@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Danh sách Sinh Viên</h1>
            <a href="{{ route('sinh-viens.create') }}" class="btn btn-primary">Thêm mới</a>
        </div>

        <div class="table-responsive">
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
                    @forelse ($sinhViens as $sinhVien)
                        <tr>
                            <td>{{ $sinhVien->ma_sv }}</td>
                            <td>{{ $sinhVien->ho_ten }}</td>
                            <td>{{ $sinhVien->gioi_tinh }}</td>
                            <td>{{ $sinhVien->ngay_sinh }}</td>
                            <td>
                                @if ($sinhVien->hinh)
                                    <img src="{{ asset($sinhVien->hinh) }}" alt="Hình" class="img-thumbnail" style="width: 50px; border-radius: 50%;">
                                @else
                                    Không có hình
                                @endif
                            </td>
                            <td>{{ $sinhVien->nganhHoc->ten_nganh }}</td>
                            <td>
                                <a href="{{ route('dang-ky.create', $sinhVien->ma_sv) }}" class="btn btn-success btn-sm">Đăng Ký</a>
                                <a href="{{ route('dang-ky.danh-sach', $sinhVien->ma_sv) }}" class="btn btn-info btn-sm">Xem Đăng Ký</a>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('sinh-viens.show', $sinhVien->ma_sv) }}" class="btn btn-info btn-sm">Xem</a>
                                    <a href="{{ route('sinh-viens.edit', $sinhVien->ma_sv) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('sinh-viens.destroy', $sinhVien->ma_sv) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Không có sinh viên nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $sinhViens->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection