@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="card login-card">
            <div class="card-header">
                Đăng Nhập Sinh Viên
            </div>
            <div class="card-body">
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="ma_sv">Mã Sinh Viên</label>
                        <input type="text" name="ma_sv" class="form-control" required value="{{ old('ma_sv') }}">
                        @error('ma_sv')
                            <span class="text-danger d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
                </form>
            </div>
        </div>
    </div>
@endsection