@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Chi tiết Học Phần
            </div>
            <div class="card-body">
                <p><strong>Mã Học Phần:</strong> {{ $hocPhan->ma_hp }}</p>
                <p><strong>Tên Học Phần:</strong> {{ $hocPhan->ten_hp }}</p>
                <p><strong>Số Tín Chỉ:</strong> {{ $hocPhan->so_tin_chi }}</p>
                <p><strong>Số Lượng Dự Kiến:</strong> {{ $hocPhan->so_luong_du_kien }}</p>
                <div class="mt-4">
                    <a href="{{ route('hoc-phans.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@endsection