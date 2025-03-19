@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Thêm mới Học Phần
            </div>
            <div class="card-body">
                <form action="{{ route('hoc-phans.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="ma_hp">Mã Học Phần</label>
                        <input type="text" name="ma_hp" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ten_hp">Tên Học Phần</label>
                        <input type="text" name="ten_hp" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="so_tin_chi">Số Tín Chỉ</label>
                        <input type="number" name="so_tin_chi" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="so_luong_du_kien">Số Lượng Dự Kiến</label>
                        <input type="number" name="so_luong_du_kien" class="form-control" value="100" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <a href="{{ route('hoc-phans.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection