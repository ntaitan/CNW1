<?php
// Tệp Controller là "não" của ứng dụng
// Import (require) tệp Model
require_once 'models/SinhVienModel.php';
// === THIẾT LẬP KẾT NỐI PDO ===
// TODO 7: Copy code PDO từ PHT Chương 4 vào đây
$host = '127.0.0.1';
$dbname = 'cse485_web';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
try {
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);} catch (PDOException $e) {
die("Kết nối thất bại: " . $e->getMessage());
}
// === KẾT THÚC KẾT NỐI PDO ===
// === LOGIC CỦA CONTROLLER ===
// Kiểm tra POST để thêm sinh viên
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ten_sinh_vien'])) {
	$ten = trim($_POST['ten_sinh_vien']);
	$email = trim($_POST['email'] ?? '');

	// Gọi hàm Model để thêm sinh viên
	addSinhVien($pdo, $ten, $email);

	// Chuyển hướng để tránh gửi lại form khi refresh
	header('Location: index.php');
	exit;
}

// Lấy danh sách sinh viên từ Model
$danh_sach_sv = getAllSinhVien($pdo);

// Include View (cuối cùng)
include 'views/SinhVien_view.php';
?>