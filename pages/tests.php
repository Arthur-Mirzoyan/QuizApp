<?php 

    include "../header_footer/header.php";
    $lessons = getLessons();
?>

<link rel="stylesheet" href="../style/tests.css">
<div class="container">
    <form action="../connection/action.php" method="post">
        <label class="firstCol count">Number of words</label>
        <input id="count" class="secondCol" type="number" min="1" max="<?php echo getWordsNumberByLesson(); ?>"
            value="1" name="count">
        <label class="firstCol lesson">Choose Lessons</label>
        <select id="lesson" class="secondCol" name="lesson">
            <option value="all">All</option>
            <?php
                if (!empty($lessons)) {
                    foreach($lessons as $rows) {
            ?>
            <option value="<?php echo $rows['lesson']?>"><?php echo $rows['lesson'] ?></option>
            <?php }} ?>
        </select>

        <input type="submit" name="create" value="Create a test">
    </form>
</div>

<?php include "../header_footer/footer.php"; ?>