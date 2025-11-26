<?php
// data.php
function getStudentList($filename) {
    if (!file_exists($filename)) {
        return ['error' => "Không tìm thấy file $filename"];
    }

    $data = [];
    $headers = [];
    
    if (($handle = fopen($filename, "r")) !== FALSE) {
        // Đọc dòng tiêu đề
        if (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $headers = $row;
        }
        // Đọc dữ liệu
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $data[] = $row;
        }
        fclose($handle);
    }
    
    return ['headers' => $headers, 'data' => $data, 'error' => null];
}
?>