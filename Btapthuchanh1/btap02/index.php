<?php require_once 'quiz-data.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trắc Nghiệm </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="quiz-container">
    <h1>📝 Kiểm Tra Kiến Thức </h1>
    
    <?php if ($error): ?>
        <div class="error-msg"><?php echo $error; ?></div>
    
    <?php else: ?>

        <?php if ($submitted): ?>
            <div class="result-bar">
                <h2>Kết quả: <?php echo $totalScore; ?> / <?php echo count($questions); ?> câu đúng</h2>
                <a href="index.php" class="btn-reset">↺ Làm lại bài thi</a>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <?php foreach ($questions as $index => $q): ?>
                <div class="question-block">
                    <div class="q-title">
                        Câu <?php echo $index + 1; ?>: <?php echo htmlspecialchars($q['text']); ?>
                        
                        <?php if ($submitted): ?>
                            <?php if ($q['is_correct']): ?>
                                <span class="correct-note">✓ ĐÚNG</span>
                            <?php else: ?>
                                <span class="wrong-note">✕ SAI</span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <?php 
                        $isMulti = count($q['answers']) > 1;
                        $inputType = $isMulti ? 'checkbox' : 'radio';
                        $inputName = $isMulti ? "question[$index][]" : "question[$index]";
                    ?>
                    
                    <?php if($isMulti): ?>
                        <div class="multi-hint">(Chọn nhiều đáp án)</div>
                    <?php endif; ?>

                    <?php foreach ($q['options'] as $key => $val): ?>
                        <label class="q-opt">
                            <?php 
                                // Logic giữ trạng thái đã chọn (checked)
                                $checked = '';
                                if ($submitted && isset($_POST['question'][$index])) {
                                    $uChoose = $_POST['question'][$index];
                                    if (is_array($uChoose)) {
                                        if (in_array($key, $uChoose)) $checked = 'checked';
                                    } else {
                                        if ($uChoose == $key) $checked = 'checked';
                                    }
                                }
                            ?>
                            <input type="<?php echo $inputType; ?>" 
                                   name="<?php echo $inputName; ?>" 
                                   value="<?php echo $key; ?>" 
                                   <?php echo $checked; ?>> 
                            <strong><?php echo $key; ?>.</strong> <?php echo htmlspecialchars($val); ?>
                        </label>
                    <?php endforeach; ?>

                    <?php if ($submitted && !$q['is_correct']): ?>
                        <div class="ans-explain">
                            👉 Đáp án đúng là: <strong><?php echo implode(', ', $q['answers']); ?></strong>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <?php if (!$submitted): ?>
                <button type="submit" class="btn-submit">NỘP BÀI</button>
            <?php endif; ?>
        </form>

    <?php endif; ?>
</div>

</body>
</html>