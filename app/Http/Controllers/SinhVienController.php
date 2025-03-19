<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\NganhHoc;

class SinhVienController extends Controller
{
    public function index()
    {
        $sinhViens = SinhVien::with('nganhHoc')->paginate(10);
        return view('sinh_viens.index', compact('sinhViens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nganhHocs = NganhHoc::all();
        return view('sinh_viens.create', compact('nganhHocs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ma_sv' => 'required|unique:sinh_viens,ma_sv|size:10',
            'ho_ten' => 'required|max:50',
            'gioi_tinh' => 'required',
            'ngay_sinh' => 'required|date',
            'hinh' => 'image|nullable|max:2048',
            'ma_nganh' => 'required|exists:nganh_hocs,ma_nganh',
        ]);

        $data = $request->all();

        if ($request->hasFile('hinh')) {
            $fileName = time() . '.' . $request->hinh->extension();
            $request->hinh->move(public_path('images'), $fileName);
            $data['hinh'] = '/images/' . $fileName;
        }

        SinhVien::create($data);

        return redirect()->route('sinh-viens.index')->with('success', 'Thêm sinh viên thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ma_sv)
    {
        $sinhVien = SinhVien::with('nganhHoc')->findOrFail($ma_sv);
        return view('sinh_viens.show', compact('sinhVien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $ma_sv)
    {
        $sinhVien = SinhVien::findOrFail($ma_sv);
        $nganhHocs = NganhHoc::all();
        return view('sinh_viens.edit', compact('sinhVien', 'nganhHocs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $ma_sv)
    {
        $request->validate([
            'ho_ten' => 'required|max:50',
            'gioi_tinh' => 'required',
            'ngay_sinh' => 'required|date',
            'hinh' => 'image|nullable|max:2048',
            'ma_nganh' => 'required|exists:nganh_hocs,ma_nganh',
        ]);

        $sinhVien = SinhVien::findOrFail($ma_sv);
        $data = $request->all();

        if ($request->hasFile('hinh')) {
            // Xóa hình cũ nếu tồn tại
            if ($sinhVien->hinh && file_exists(public_path($sinhVien->hinh))) {
                unlink(public_path($sinhVien->hinh));
            }
            $fileName = time() . '.' . $request->hinh->extension();
            $request->hinh->move(public_path('images'), $fileName);
            $data['hinh'] = '/images/' . $fileName;
        }

        $sinhVien->update($data);

        return redirect()->route('sinh-viens.index')->with('success', 'Cập nhật sinh viên thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $ma_sv)
    {
        $sinhVien = SinhVien::findOrFail($ma_sv);

        // Xóa hình nếu tồn tại
        if ($sinhVien->hinh && file_exists(public_path($sinhVien->hinh))) {
            unlink(public_path($sinhVien->hinh));
        }

        $sinhVien->delete();

        return redirect()->route('sinh-viens.index')->with('success', 'Xóa sinh viên thành công!');
    }
}
