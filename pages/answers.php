<?php

    include "../header_footer/header.php";
    $result = $_SESSION['SCORE'];
    $words = $result["words"];
    $variants = $result["variants"];
    $answers = $result["answers"];

?>

<link rel="stylesheet" href="../style/quiz.css">
<link rel="stylesheet" href="../style/answers.css">
<div class="container">
    <div class="info">
        <h3>Total Questions : <?php echo $result["totalQuestions"] ?></h3>
        <h3>Percentage : <?php echo $result["percentage"] ?>%</h3>
        <h3>Correct Answers : <?php echo $result["correctAnswers"] ?></h3>
    </div>
    <?php
            if (!empty($variants)) {
                $i = 0;
                foreach($variants as $word => $explanation) {
                    $isCorrect = (($explanation == $word && $answers[$i] == 'T') || ($explanation != $word && $answers[$i] == 'F'));
                    $correctAnswer = ucfirst($words[$word]["explanation"]);
                    $x = ucfirst($words[$word]["word"]);
                    $y = ucfirst($words[$explanation]["explanation"]);
        ?>
    <div class="box" style="background-Color: <?php echo $isCorrect ? "#88fc88" : "#f57c78" ?>;">
        <div class="word"><?php echo $x; ?></div>
        <div class="explanation"><?php echo $y; ?></div>
        <div class="choise">
            <p>Your answer was : <?php if ($answers[$i] == 'T') echo "TRUE"; else echo "FALSE"; ?></p>
            <p>
                <?php                 
                    if (!$isCorrect) echo "Correct answer is : $correctAnswer";
                    else echo "Correct explanation of <i><u>$x</u></i> is : $correctAnswer";
                ?>
            </p>
        </div>
    </div>
    <?php $i++; }} ?>
</div>

<?php include "../header_footer/footer.php"; ?>