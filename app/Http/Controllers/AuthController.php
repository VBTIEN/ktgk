<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'ma_sv' => 'required|exists:sinh_viens,ma_sv',
        ]);

        $ma_sv = $request->input('ma_sv');
        $sinhVien = SinhVien::where('ma_sv', $ma_sv)->first();

        if ($sinhVien) {
            // Lưu thông tin sinh viên vào session
            session(['sinh_vien' => $sinhVien]);

            // Chuyển hướng đến trang chi tiết sinh viên
            return redirect()->route('sinh-viens.show', $sinhVien->ma_sv)
                ->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['ma_sv' => 'Mã sinh viên không tồn tại.']);
    }

    // Đăng xuất
    public function logout()
    {
        session()->forget('sinh_vien');
        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');
    }
}
