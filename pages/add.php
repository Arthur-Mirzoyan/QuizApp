<?php
    $lessons = getLessons();
?>

<link rel="stylesheet" href="../style/add.css">
<div id="ADD">
    <form action="../connection/action.php" method="post">
        <input type="text" name="word" placeholder="Word" required>
        <input list="lesson-list" id="lesson" type="text" name="lesson" placeholder="Lesson" required>
        <?php if(!empty($lessons)) ?>
        <datalist id="lesson-list">
            <?php
                foreach($lessons as $rows) { ?>
                    <option value="<?php echo $rows['lesson']; ?>">
            <?php } ?>
        </datalist>
        <textarea wrap="soft" rows="15" name="explanation" placeholder="Explanation" required></textarea>
        <input id="addBtn" type="submit" name="add" value="Add the word">
    </form>
</div>