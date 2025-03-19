@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Thêm mới Học Phần</h1>
        <form action="{{ route('hoc-phans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="ma_hp">Mã Học Phần</label>
                <input type="text" name="ma_hp" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="ten_hp">Tên Học Phần</label>
                <input type="text" name="ten_hp" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="so_tin_chi">Số Tín Chỉ</label>
                <input type="number" name="so_tin_chi" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="so_luong_du_kien">Số Lượng Dự Kiến</label>
                <input type="number" name="so_luong_du_kien" class="form-control" value="100" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('hoc-phans.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection