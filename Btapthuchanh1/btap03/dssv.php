<?php
// KẾT NỐI LOGIC
require_once 'data.php';

// CẤU HÌNH TÊN FILE
$filename = '65HTTT_Danh_sach_diem_danh.csv';
$result = getStudentList($filename);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên - 65HTTT</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="container">
    <h1><i class="fas fa-user-graduate"></i> Danh Sách Điểm Danh</h1>
    <p class="subtitle">Hệ thống quản lý sinh viên lớp 65HTTT</p>

    <?php if (isset($result['error']) && $result['error']): ?>
        <div class="error-box">
            <i class="fas fa-exclamation-circle"></i> <?php echo $result['error']; ?>
        </div>
    
    <?php else: ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <?php foreach ($result['headers'] as $header): ?>
                            <th><?php echo htmlspecialchars(trim($header)); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $stt = 1;
                    foreach ($result['data'] as $student): 
                    ?>
                        <tr>
                            <td class="stt-col"><?php echo $stt++; ?></td>
                            
                            <?php foreach ($student as $cell): ?>
                                <td>
                                    <?php 
                                    if (trim($cell) !== '') {
                                        echo htmlspecialchars($cell);
                                    } else {
                                        echo '<span class="empty-cell">-</span>';
                                    }
                                    ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 20px; text-align: right; color: #666; font-size: 0.9em;">
            <strong>Tổng số:</strong> <?php echo count($result['data']); ?> sinh viên
        </div>

    <?php endif; ?>
</div>

</body>
</html>