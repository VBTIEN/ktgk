@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Đăng ký Học Phần cho Sinh Viên: {{ $sinhVien->ho_ten }}</h1>

        <!-- Form chọn học phần và thêm vào giỏ hàng -->
        <form action="{{ route('dang-ky.them-gio-hang', $sinhVien->ma_sv) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="hoc_phans">Chọn Học Phần</label>
                <select name="hoc_phans[]" class="form-control" multiple required>
                    @foreach ($hocPhans as $hocPhan)
                        <option value="{{ $hocPhan->ma_hp }}">
                            {{ $hocPhan->ten_hp }} ({{ $hocPhan->so_tin_chi }} tín chỉ, Còn: {{ $hocPhan->so_luong_du_kien }} chỗ)
                        </option>
                    @endforeach
                </select>
                <small>Nhấn giữ Ctrl để chọn nhiều học phần</small>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm vào học phần</button>
        </form>

        <!-- Hiển thị giỏ hàng -->
        <h3 class="mt-5">Danh sách Học Phần</h3>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (!empty($gioHang))
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Mã Học Phần</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gioHang as $ma_hp)
                        @php
                            $hocPhan = $hocPhans->where('ma_hp', $ma_hp)->first();
                        @endphp
                        @if ($hocPhan)
                            <tr>
                                <td>{{ $hocPhan->ma_hp }}</td>
                                <td>{{ $hocPhan->ten_hp }}</td>
                                <td>{{ $hocPhan->so_tin_chi }}</td>
                                <td>
                                    <form action="{{ route('dang-ky.xoa-gio-hang', [$sinhVien->ma_sv, $hocPhan->ma_hp]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa học phần này khỏi giỏ hàng?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <!-- Form lưu đăng ký -->
            <form action="{{ route('dang-ky.luu', $sinhVien->ma_sv) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="ngay_dk">Ngày Đăng Ký</label>
                    <input type="date" name="ngay_dk" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success mt-3">Lưu Đăng Ký</button>
            </form>
        @else
            <p>Chưa có học phần nào trong giỏ hàng.</p>
        @endif

        <a href="{{ route('sinh-viens.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
    </div>
@endsection