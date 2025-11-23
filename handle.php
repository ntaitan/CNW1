<?php
// TODO 1: (Cực kỳ quan trọng) Khởi động session
session_start();

// TODO 2: Kiểm tra xem người dùng đã nhấn nút "Đăng nhập" (gửi form) chưa
if ( isset($_POST['username']) ) {
// TODO 3: Nếu đã gửi form, lấy dữ liệu 'username' và 'password' từ $_POST
    
    $user = $_POST['username']; // Gợi ý: $_POST['...']
    $pass = $_POST['password']; // Gợi ý: $_POST['...']
// TODO 4: (Giả lập) Kiểm tra logic đăng nhập

    if ($user == 'admin' && $pass == '123') {
// TODO 5: Nếu thành công, lưu tên username vào SESSION
        $_SESSION['username'] = $user;
// TODO 6: Chuyển hướng người dùng sang trang "chào mừng"
        header('Location: welcome.php');    
        exit;
    } else {
        header('Location: login.html?error=1'); // Kèm theo thông báo lỗi trên
        exit;
    }

}
// TODO 7: Nếu người dùng truy cập trực tiếp file này (không qua POST),
// "đá" họ về trang login.html
else {
    header('Location: login.html');
    exit;
}
?>