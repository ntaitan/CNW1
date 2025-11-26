<?php
// --- BƯỚC 1: KHỞI TẠO DỮ LIỆU ---
// Cập nhật mảng flowers với 4 loại hoa từ hình ảnh bạn cung cấp
$flowers = [
    [
        "name" => "Hoa Hải Đường",
        "description" => "Hải đường mang ý nghĩa phú quý, anh em hòa hợp, thường nở rực rỡ vào dịp Tết đến xuân về.",
        "image" => "images/haiduong.jpg"
    ],
    [
        "name" => "Hoa Mai",
        "description" => "Biểu tượng của mùa xuân miền Nam, màu vàng rực rỡ mang lại may mắn, tài lộc và sự thịnh vượng.",
        "image" => "images/mai.jpg"
    ],
    [
        "name" => "Hoa Đỗ Quyên",
        "description" => "Loài hoa báo hiệu mùa xuân, có màu sắc tươi sáng, tượng trưng cho tình yêu đôi lứa và hạnh phúc gia đình.",
        "image" => "images/doquyen.jpg"
    ],
    [
        "name" => "Hoa Tường Vy",
        "description" => "Những cánh hoa mỏng manh như cánh bướm, thường leo giàn tạo bóng mát và vẻ đẹp lãng mạn cho ngôi nhà.",
        "image" => "images/tuongvy.jpg"
    ]
];

// --- BƯỚC 2: XỬ LÝ LOGIC ---
// Lấy chế độ xem từ URL (ví dụ: ?mode=admin), mặc định là 'guest'
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'guest';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bộ sưu tập Hoa Xuân Hè</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 1000px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; }
        h1 { text-align: center; color: #d35400; text-transform: uppercase; margin-bottom: 30px; }
        
        /* Navigation */
        .nav { text-align: center; margin-bottom: 30px; }
        .nav a {
            display: inline-block; text-decoration: none; padding: 10px 25px; margin: 0 5px;
            background-color: #fff; color: #555; border: 1px solid #ddd; border-radius: 25px;
            transition: all 0.3s;
        }
        .nav a:hover { background-color: #eee; }
        .nav a.active { background-color: #d35400; color: white; border-color: #d35400; box-shadow: 0 4px 6px rgba(211, 84, 0, 0.3); }

        /* Guest View (Grid System) */
        .guest-view { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 25px; }
        .card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 3px 10px rgba(0,0,0,0.08); transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); }
        .card img { width: 100%; height: 180px; object-fit: cover; }
        .card-body { padding: 15px; }
        .card-title { font-weight: bold; font-size: 1.1em; margin-bottom: 8px; color: #2c3e50; }
        .card-text { font-size: 0.9em; color: #666; line-height: 1.4; }

        /* Admin View (Table) */
        .admin-panel h3 { color: #2c3e50; border-bottom: 2px solid #d35400; display: inline-block; padding-bottom: 5px; }
        .btn-add { background-color: #27ae60; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; float: right; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #34495e; color: white; font-weight: 500; }
        tr:hover { background-color: #f5f5f5; }
        
        .thumb-admin { width: 60px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; }
        
        .actions a { display: inline-block; padding: 6px 12px; margin-right: 5px; border-radius: 4px; text-decoration: none; color: white; font-size: 0.85em; }
        .btn-edit { background-color: #3027aeff; }
        .btn-delete { background-color: #0e0e0eff; }
    </style>
</head>
<body>

    <h1>Các Loài Hoa Đẹp </h1>

    <div class="nav">
        <a href="?mode=guest" class="<?php echo $mode == 'guest' ? 'active' : ''; ?>">Xem danh sách (Khách)</a>
        <a href="?mode=admin" class="<?php echo $mode == 'admin' ? 'active' : ''; ?>">Quản lý (Admin)</a>
    </div>

    <?php if ($mode == 'guest'): ?>
        
        <div class="guest-view">
            <?php foreach ($flowers as $flower): ?>
                <div class="card">
                    <img src="<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>">
                    <div class="card-body">
                        <div class="card-title"><?php echo $flower['name']; ?></div>
                        <div class="card-text"><?php echo $flower['description']; ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>

        <div class="admin-panel">
            <button class="btn-add">+ Thêm mới</button>
            <h3>Danh sách hoa hiện có</h3>
            
            <table>
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="25%">Tên hoa</th>
                        <th width="15%">Hình ảnh</th>
                        <th width="40%">Mô tả</th>
                        <th width="15%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($flowers as $index => $flower): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><strong><?php echo $flower['name']; ?></strong></td>
                            <td>
                                <img src="<?php echo $flower['image']; ?>" class="thumb-admin" alt="thumb">
                            </td>
                            <td><?php echo $flower['description']; ?></td>
                            <td class="actions">
                                <a href="#" class="btn-edit">Sửa</a>
                                <a href="#" class="btn-delete">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php endif; ?>

</body>
</html>