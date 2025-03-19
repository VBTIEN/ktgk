@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Đăng ký Học Phần cho Sinh Viên: {{ $sinhVien->ho_ten }}
            </div>
            <div class="card-body">
                <!-- Form chọn học phần và thêm vào giỏ hàng -->
                <form action="{{ route('dang-ky.them-gio-hang', $sinhVien->ma_sv) }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="hoc_phans">Chọn Học Phần</label>
                        <select name="hoc_phans[]" class="form-select" multiple required style="height: 200px;">
                            @foreach ($hocPhans as $hocPhan)
                                <option value="{{ $hocPhan->ma_hp }}">
                                    {{ $hocPhan->ten_hp }} ({{ $hocPhan->so_tin_chi }} tín chỉ, Còn: {{ $hocPhan->so_luong_du_kien }} chỗ)
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Nhấn giữ Ctrl để chọn nhiều học phần</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm vào danh sách đăng ký</button>
                </form>

                <!-- Hiển thị giỏ hàng -->
                <h3 class="mt-5">Danh sách Học Phần chưa lưu</h3>
                @if (!empty($gioHang))
                    <div class="d-flex justify-content-end mb-3">
                        <form action="{{ route('dang-ky.xoa-tat-ca-gio-hang', $sinhVien->ma_sv) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa tất cả học phần trong giỏ hàng?')">Xóa Tất Cả</button>
                        </form>
                    </div>
                    <div class="table-responsive">
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
                    </div>

                    <!-- Form lưu đăng ký -->
                    <form action="{{ route('dang-ky.luu', $sinhVien->ma_sv) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="ngay_dk">Ngày Đăng Ký</label>
                            <input type="date" name="ngay_dk" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Lưu Đăng Ký</button>
                    </form>
                @else
                    <p class="text-muted">Chưa có học phần nào trong danh sách.</p>
                @endif

                <div class="mt-4">
                    <a href="{{ route('sinh-viens.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@endsection