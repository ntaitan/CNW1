<?php
// Tệp View CHỈ chứa HTML và logic hiển thị (echo, foreach)
// Tệp View KHÔNG chứa câu lệnh SQL
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>PHT Chương 5 - MVC</title>
<style>
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #ddd; padding: 8px; }
th { background-color: #f2f2f2; }
</style>
</head>
<body>
<h2>Thêm Sinh Viên Mới </h2>
<form method="post" action="index.php" style="margin-bottom:20px;">
    <label for="ten_sinh_vien">Tên Sinh Viên:</label>
    <input type="text" id="ten_sinh_vien" name="ten_sinh_vien" required />
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" />
    
    <button type="submit">Thêm sinh viên</button>
</form>

<h2>Danh Sách Sinh Viên </h2>
<table>
<tr>
<th>ID</th>
<th>Tên Sinh Viên</th>
<th>Email</th>
<th>Ngày Tạo</th>
</tr><?php
// Duyệt qua danh sách sinh viên được Controller truyền sang
if (!empty($danh_sach_sv) && is_array($danh_sach_sv)) {
	foreach ($danh_sach_sv as $sv) {
		$id = htmlspecialchars($sv['id'] ?? '');
		// Một số model có tên cột khác nhau, thử một số khóa thông dụng
		$ten = htmlspecialchars($sv['ten_sinh_vien'] ?? $sv['ten'] ?? $sv['ten_sv'] ?? '');
		$email = htmlspecialchars($sv['email'] ?? '');
		$ngay_tao = htmlspecialchars($sv['ngay_tao'] ?? $sv['created_at'] ?? $sv['ngayTao'] ?? '');

		echo "<tr>";
		echo "<td>{$id}</td>";
		echo "<td>{$ten}</td>";
		echo "<td>{$email}</td>";
		echo "<td>{$ngay_tao}</td>";
		echo "</tr>";
	}
} else {
	echo '<tr><td colspan="4">Không có sinh viên nào.</td></tr>';
}
?>
</table>
</body>
</html>