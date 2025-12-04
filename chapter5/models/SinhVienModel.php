<?php

function getAllSinhVien($pdo) {
    $sql = "SELECT * FROM sinhvien";
    $stmt = $pdo->query($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll(); // Trả về tất cả kết quả dưới dạng mảng
}   

function addSinhVien($pdo, $ten, $email) {
    $sql = "INSERT INTO sinhvien (ten_sinh_vien, email) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ten, $email]);
}
?>