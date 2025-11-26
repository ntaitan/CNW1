<?php
// quiz-data.php

// 1. Cấu hình & Hàm xử lý
$filename = 'Quiz.txt';

function getAllQuestions($filename) {
    $questions = [];
    
    // Kiểm tra file có tồn tại không
    if (!file_exists($filename)) {
        return ['error' => "Lỗi: Không tìm thấy file <strong>$filename</strong>. Vui lòng kiểm tra lại thư mục chứa file."];
    }

    $content = file_get_contents($filename);
    
    // Tách dòng (hỗ trợ cả Windows và Linux)
    $lines = preg_split('/\r\n|\r|\n/', $content);
    
    $currentQuestion = [
        'text' => '',
        'options' => [],
        'answers' => []
    ];
    
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;

        // Tìm dòng ANSWER:
        if (strpos($line, 'ANSWER:') === 0) {
            $ansStr = substr($line, 7);
            $ansArr = explode(',', $ansStr);
            $currentQuestion['answers'] = array_map('trim', $ansArr);
            
            if (!empty($currentQuestion['text'])) {
                $questions[] = $currentQuestion;
            }
            // Reset cho câu mới
            $currentQuestion = ['text' => '', 'options' => [], 'answers' => []];
        } 
        // Tìm các đáp án A. B. C. D.
        elseif (preg_match('/^[A-D]\./', $line)) {
            $optKey = substr($line, 0, 1);
            $optText = substr($line, 2);
            $currentQuestion['options'][$optKey] = trim($optText);
        } 
        // Tìm nội dung câu hỏi
        else {
            $currentQuestion['text'] .= $line . " ";
        }
    }
    return ['data' => $questions, 'error' => null];
}

// 2. Chạy logic khởi tạo biến
// Phần này cực kỳ quan trọng để tránh lỗi "Undefined variable"
$result = getAllQuestions($filename);
$questions = $result['data'] ?? [];
$error = $result['error'];

$submitted = false;
$totalScore = 0;

// 3. Xử lý chấm điểm khi người dùng ấn Submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error) {
    $submitted = true;
    $userAnswers = $_POST['question'] ?? [];

    foreach ($questions as $index => $q) {
        $userAns = isset($userAnswers[$index]) ? $userAnswers[$index] : [];
        if (!is_array($userAns)) $userAns = [$userAns];

        $diff1 = array_diff($q['answers'], $userAns);
        $diff2 = array_diff($userAns, $q['answers']);

        if (empty($diff1) && empty($diff2) && count($q['answers']) === count($userAns)) {
            $totalScore++;
            $questions[$index]['is_correct'] = true;
        } else {
            $questions[$index]['is_correct'] = false;
        }
    }
}
?>