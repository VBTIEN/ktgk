@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Danh sách Học Phần đã Đăng Ký của Sinh Viên: {{ $sinhVien->ho_ten }}
            </div>
            <div class="card-body">
                @if ($dangKies->isNotEmpty())
                    <form action="{{ route('dang-ky.xoa-tat-ca', $sinhVien->ma_sv) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Bạn có chắc muốn xóa tất cả học phần đã đăng ký?')">Xóa Tất Cả</button>
                    </form>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã Đăng Ký</th>
                                <th>Ngày Đăng Ký</th>
                                <th>Học Phần</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dangKies as $dangKy)
                                <tr>
                                    <td>{{ $dangKy->ma_dk }}</td>
                                    <td>{{ $dangKy->ngay_dk }}</td>
                                    <td>
                                        @foreach ($dangKy->chiTietDangKies as $chiTiet)
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span>{{ $chiTiet->hocPhan->ten_hp }} ({{ $chiTiet->hocPhan->so_tin_chi }} tín chỉ)</span>
                                                <form action="{{ route('dang-ky.xoa-hoc-phan', [$dangKy->ma_dk, $chiTiet->ma_hp]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa học phần này?')">Xóa</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <!-- Có thể thêm các hành động khác nếu cần -->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Chưa có học phần nào được đăng ký.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('dang-ky.create', $sinhVien->ma_sv) }}" class="btn btn-primary">Đăng Ký Thêm</a>
                    <a href="{{ route('sinh-viens.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@endsection