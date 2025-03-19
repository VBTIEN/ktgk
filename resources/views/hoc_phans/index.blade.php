@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Danh sách Học Phần</h1>
            <a href="{{ route('hoc-phans.create') }}" class="btn btn-primary">Thêm mới</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                        <th>Số Lượng Dự Kiến</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hocPhans as $hocPhan)
                        <tr>
                            <td>{{ $hocPhan->ma_hp }}</td>
                            <td>{{ $hocPhan->ten_hp }}</td>
                            <td>{{ $hocPhan->so_tin_chi }}</td>
                            <td>{{ $hocPhan->so_luong_du_kien }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('hoc-phans.show', $hocPhan->ma_hp) }}" class="btn btn-info btn-sm">Xem</a>
                                    <a href="{{ route('hoc-phans.edit', $hocPhan->ma_hp) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('hoc-phans.destroy', $hocPhan->ma_hp) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Không có học phần nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $hocPhans->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection