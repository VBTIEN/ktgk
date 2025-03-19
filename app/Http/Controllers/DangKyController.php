<?php

namespace App\Http\Controllers;

use App\Models\SinhVien;
use App\Models\HocPhan;
use App\Models\DangKy;
use App\Models\ChiTietDangKy;
use Illuminate\Http\Request;

class DangKyController extends Controller
{
    // Hiển thị form đăng ký học phần
    public function create(string $ma_sv)
    {
        $sinhVien = SinhVien::findOrFail($ma_sv);
        $hocPhans = HocPhan::all();

        // Lấy danh sách học phần trong giỏ hàng từ session
        $gioHang = session('gio_hang', []);

        return view('dang_ky.create', compact('sinhVien', 'hocPhans', 'gioHang'));
    }

    // Thêm học phần vào giỏ hàng (lưu tạm thời trong session)
    public function themVaoGioHang(Request $request, string $ma_sv)
    {
        $request->validate([
            'hoc_phans' => 'required|array',
            'hoc_phans.*' => 'exists:hoc_phans,ma_hp',
        ]);

        $sinhVien = SinhVien::findOrFail($ma_sv);

        // Lấy giỏ hàng hiện tại từ session, nếu chưa có thì khởi tạo mảng rỗng
        $gioHang = session('gio_hang', []);

        // Thêm các học phần được chọn vào giỏ hàng
        foreach ($request->hoc_phans as $ma_hp) {
            if (!in_array($ma_hp, $gioHang)) {
                $gioHang[] = $ma_hp;
            }
        }

        // Lưu giỏ hàng vào session
        session(['gio_hang' => $gioHang]);

        return redirect()->route('dang-ky.create', $sinhVien->ma_sv)
            ->with('success', 'Thêm học phần vào giỏ hàng thành công!');
    }

    // Xóa học phần khỏi giỏ hàng
    public function xoaKhoiGioHang(string $ma_sv, string $ma_hp)
    {
        $sinhVien = SinhVien::findOrFail($ma_sv);

        // Lấy giỏ hàng từ session
        $gioHang = session('gio_hang', []);

        // Xóa học phần khỏi giỏ hàng
        $gioHang = array_filter($gioHang, function ($item) use ($ma_hp) {
            return $item !== $ma_hp;
        });

        // Cập nhật lại giỏ hàng trong session
        session(['gio_hang' => array_values($gioHang)]);

        return redirect()->route('dang-ky.create', $sinhVien->ma_sv)
            ->with('success', 'Xóa học phần khỏi giỏ hàng thành công!');
    }

    // Lưu thông tin đăng ký từ giỏ hàng vào database
    public function luuDangKy(Request $request, string $ma_sv)
    {
        $request->validate([
            'ngay_dk' => 'required|date',
        ]);

        $sinhVien = SinhVien::findOrFail($ma_sv);

        // Lấy giỏ hàng từ session
        $gioHang = session('gio_hang', []);

        if (empty($gioHang)) {
            return redirect()->route('dang-ky.create', $sinhVien->ma_sv)
                ->with('error', 'Giỏ hàng trống, vui lòng chọn học phần trước khi lưu!');
        }

        // Kiểm tra số lượng dự kiến trước khi lưu
        $hocPhans = HocPhan::whereIn('ma_hp', $gioHang)->get();
        foreach ($hocPhans as $hocPhan) {
            if ($hocPhan->so_luong_du_kien <= 0) {
                return redirect()->route('dang-ky.create', $sinhVien->ma_sv)
                    ->with('error', "Học phần {$hocPhan->ten_hp} đã hết chỗ!");
            }
        }

        // Tạo bản ghi trong bảng dang_kies
        $dangKy = DangKy::create([
            'ngay_dk' => $request->ngay_dk,
            'ma_sv' => $sinhVien->ma_sv,
        ]);

        // Lưu các học phần từ giỏ hàng vào bảng chi_tiet_dang_kies
        foreach ($gioHang as $ma_hp) {
            ChiTietDangKy::create([
                'ma_dk' => $dangKy->ma_dk,
                'ma_hp' => $ma_hp,
            ]);

            // Giảm số lượng dự kiến của học phần
            $hocPhan = HocPhan::find($ma_hp);
            if ($hocPhan) {
                $hocPhan->so_luong_du_kien -= 1; // Giảm 1 đơn vị cho mỗi sinh viên đăng ký
                $hocPhan->save();
            }
        }

        // Xóa giỏ hàng sau khi lưu thành công
        session()->forget('gio_hang');

        return redirect()->route('dang-ky.danh-sach', $sinhVien->ma_sv)
            ->with('success', 'Lưu đăng ký học phần thành công!');
    }

    // Hiển thị danh sách học phần đã đăng ký
    public function danhSach(string $ma_sv)
    {
        $sinhVien = SinhVien::findOrFail($ma_sv);
        $dangKies = DangKy::where('ma_sv', $ma_sv)
            ->with('chiTietDangKies.hocPhan')
            ->get();
        return view('dang_ky.danh_sach', compact('sinhVien', 'dangKies'));
    }

    public function xoaHocPhan($ma_dk, $ma_hp)
    {
        // Xóa bản ghi trong chi_tiet_dang_kies
        $deleted = ChiTietDangKy::where('ma_dk', $ma_dk)
            ->where('ma_hp', $ma_hp)
            ->delete();

        if ($deleted) {
            // Tăng lại số lượng dự kiến của học phần
            $hocPhan = HocPhan::find($ma_hp);
            if ($hocPhan) {
                $hocPhan->so_luong_du_kien += 1;
                $hocPhan->save();
            }

            // Tìm bản ghi trong dang_kies
            $dangKy = DangKy::find($ma_dk);

            // Kiểm tra nếu dangKy tồn tại và không còn học phần nào trong đăng ký này
            if ($dangKy && $dangKy->chiTietDangKies()->count() == 0) {
                $dangKy->delete();
            }

            return redirect()->back()->with('success', 'Xóa học phần thành công!');
        }

        return redirect()->back()->with('error', 'Không tìm thấy học phần để xóa.');
    }

    public function xoaTatCa($ma_sv)
    {
        $sinhVien = SinhVien::findOrFail($ma_sv);

        // Lấy danh sách học phần đã đăng ký trước khi xóa
        $chiTietDangKies = ChiTietDangKy::whereIn('ma_dk', $sinhVien->dangKies->pluck('ma_dk'))->get();

        // Xóa tất cả bản ghi trong chi_tiet_dang_kies
        ChiTietDangKy::whereIn('ma_dk', $sinhVien->dangKies->pluck('ma_dk'))->delete();

        // Xóa tất cả bản ghi trong dang_kies
        $sinhVien->dangKies()->delete();

        // Tăng lại số lượng dự kiến cho từng học phần
        foreach ($chiTietDangKies as $chiTiet) {
            $hocPhan = HocPhan::find($chiTiet->ma_hp);
            if ($hocPhan) {
                $hocPhan->so_luong_du_kien += 1;
                $hocPhan->save();
            }
        }

        return redirect()->back()->with('success', 'Xóa tất cả học phần đã đăng ký thành công!');
    }
}