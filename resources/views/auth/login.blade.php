@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Đăng Nhập Sinh Viên</h1>
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="ma_sv">Mã Sinh Viên</label>
                <input type="text" name="ma_sv" class="form-control" required>
                @error('ma_sv')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Đăng Nhập</button>
        </form>
    </div>
@endsection