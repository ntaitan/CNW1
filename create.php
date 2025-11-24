<?php
session_start();
// Nếu session chưa có danh sách, nạp mảng mẫu từ data.php
if (!isset($_SESSION['do_an_list'])) {
    require 'data.php';
    if (isset($do_an_list) && is_array($do_an_list)) {
        $_SESSION['do_an_list'] = $do_an_list;
    } else {
        $_SESSION['do_an_list'] = [];
    }
}

$thong_bao = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_de_tai    = trim($_POST['ten_de_tai'] ?? '');
    $ten_sinh_vien = trim($_POST['ten_sinh_vien'] ?? '');
    $mssv          = trim($_POST['mssv'] ?? '');
    $giang_vien_hd = trim($_POST['giang_vien_hd'] ?? '');
    $nam_hoc       = trim($_POST['nam_hoc'] ?? '');
    $trang_thai    = $_POST['trang_thai'] ?? 'Đang thực hiện';

    // Lấy danh sách hiện có từ session
    $do_an_list = $_SESSION['do_an_list'];

    // Tạo id mới an toàn
    $new_id = 1;
    if (!empty($do_an_list)) {
        $ids = array_column($do_an_list, 'id');
        $new_id = (int)max($ids) + 1;
    }

    $new_item = [
        'id' => $new_id,
        'ten_de_tai'    => $ten_de_tai,
        'ten_sinh_vien' => $ten_sinh_vien,
        'mssv'          => $mssv,
        'giang_vien_hd' => $giang_vien_hd,
        'nam_hoc'       => $nam_hoc,
        'trang_thai'    => $trang_thai,
        'created_at'    => date('Y-m-d H:i:s')
    ];

    // Thêm vào session và chuyển hướng về index để hiển thị
    $do_an_list[] = $new_item;
    $_SESSION['do_an_list'] = $do_an_list;

    header("Location: index.php?success=created");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm đồ án mới (Demo POST)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="navbar">
    <div>Quản lý Đồ án Tốt nghiệp</div>
    <div>
        <a href="index.php">Dashboard</a>
    </div>
</div>

<div class="container">
    <h2>Thêm đồ án mới</h2>
    <p>Form này chỉ dùng để minh họa cách gửi dữ liệu bằng <b>POST</b> trong PHP, chưa lưu vào CSDL.</p>

    <form action="create.php" method="POST">
        <div style="margin-bottom:10px;">
            <label>Tên đề tài</label><br>
            <input type="text" name="ten_de_tai" style="width:100%; padding:6px;" required>
        </div>
        <div style="margin-bottom:10px;">
            <label>Tên sinh viên</label><br>
            <input type="text" name="ten_sinh_vien" style="width:100%; padding:6px;" required>
        </div>
        <div style="margin-bottom:10px;">
            <label>MSSV</label><br>
            <input type="text" name="mssv" style="width:100%; padding:6px;" required>
        </div>
        <div style="margin-bottom:10px;">
            <label>Giảng viên hướng dẫn</label><br>
            <input type="text" name="giang_vien_hd" style="width:100%; padding:6px;" required>
        </div>
        <div style="margin-bottom:10px;">
            <label>Năm học (vd: 2024-2025)</label><br>
            <input type="text" name="nam_hoc" style="width:100%; padding:6px;" required>
        </div>
        <div style="margin-bottom:10px;">
            <label>Trạng thái</label><br>
            <select name="trang_thai" style="width:100%; padding:6px;">
                <option value="Đang thực hiện">Đang thực hiện</option>
                <option value="Hoàn thành">Hoàn thành</option>
                <option value="Chưa bắt đầu">Chưa bắt đầu</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Gửi dữ liệu (POST)</button>
        
        <a href="index.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>
