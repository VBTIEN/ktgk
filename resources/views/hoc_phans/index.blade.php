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
        @foreach ($hocPhans as $hocPhan)
            <tr>
                <td>{{ $hocPhan->ma_hp }}</td>
                <td>{{ $hocPhan->ten_hp }}</td>
                <td>{{ $hocPhan->so_tin_chi }}</td>
                <td>{{ $hocPhan->so_luong_du_kien }}</td>
                <td>
                    <a href="{{ route('hoc-phans.show', $hocPhan->ma_hp) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('hoc-phans.edit', $hocPhan->ma_hp) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('hoc-phans.destroy', $hocPhan->ma_hp) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>