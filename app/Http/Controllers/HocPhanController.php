<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HocPhan;

class HocPhanController extends Controller
{
    public function index()
    {
        $hocPhans = HocPhan::paginate(10);
        return view('hoc_phans.index', compact('hocPhans'));
    }

    public function create()
    {
        return view('hoc_phans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ma_hp' => 'required|unique:hoc_phans,ma_hp|size:6',
            'ten_hp' => 'required|max:30',
            'so_tin_chi' => 'required|integer|min:1',
            'so_luong_du_kien' => 'required|integer|min:0',
        ]);

        HocPhan::create($request->all());

        return redirect()->route('hoc_phans.index')->with('success', 'Thêm học phần thành công!');
    }

    public function show(string $ma_hp)
    {
        $hocPhan = HocPhan::findOrFail($ma_hp);
        return view('hoc_phans.show', compact('hocPhan'));
    }

    public function edit(string $ma_hp)
    {
        $hocPhan = HocPhan::findOrFail($ma_hp);
        return view('hoc_phans.edit', compact('hocPhan'));
    }

    public function update(Request $request, string $ma_hp)
    {
        $request->validate([
            'ten_hp' => 'required|max:30',
            'so_tin_chi' => 'required|integer|min:1',
            'so_luong_du_kien' => 'required|integer|min:0',
        ]);
    
        $hocPhan = HocPhan::findOrFail($ma_hp);
        $hocPhan->update($request->all());
    
        return redirect()->route('hoc_phans.index')->with('success', 'Cập nhật học phần thành công!');
    }

    public function destroy(string $ma_hp)
    {
        $hocPhan = HocPhan::findOrFail($ma_hp);
        $hocPhan->delete();

        return redirect()->route('hoc_phans.index')->with('success', 'Xóa học phần thành công!');
    }
}
