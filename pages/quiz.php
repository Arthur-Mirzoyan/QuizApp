<?php 

    include "../header_footer/header.php";
    if (!isset($_SESSION['WORDS'])) {
        echo "<h1>No test.</h1>";
    }
    else {
    $words = $_SESSION['WORDS'];
    $_SESSION['VARIANTS'] = $variants = createRandomList($words);

?>

<link rel="stylesheet" href="../style/quiz.css">
<div class="container">
    <form action="../connection/action.php" method="post">
        <?php
            if (!empty($variants)) {
                $i = 0;
                foreach($variants as $word => $explanation) {
        ?>
        <div class="box">
            <div class="word"><?php echo $words[$word]["word"]; ?></div>
            <div class="explanation"><?php echo $words[$explanation]["explanation"]; ?></div>
            <div class="choise">
                <label>True<input class="checkboxes" onchange="isValidChange(<?php echo $i ?>)" type="checkbox"
                        name="answer[]" value="T" required></label>
                <label>False<input class="checkboxes" onchange="isValidChange(<?php echo ++$i ?>)" type="checkbox"
                        name="answer[]" value="F" required></label>
            </div>
        </div>
        <?php $i++; }} ?>
        <input id="checkBtn" type="submit" name="check" value="CHECK">
    </form>
</div>

<?php } include "../header_footer/footer.php"; ?>