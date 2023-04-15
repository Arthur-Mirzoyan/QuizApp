<?php
    include "../header_footer/header.php";

    $lessons = getLessons();
?>
<link rel="stylesheet" href="../style/add.css">
<div class="container">
    <form action="../connection/action.php" method="post">
        <input type="text" name="word" placeholder="Word" required>
        <input id="lesson" type="text" name="lesson" placeholder="Lesson" required>
        <textarea wrap="soft" rows="15" name="explanation" placeholder="Explanation" required></textarea>
        <input id="addBtn" type="submit" name="add" value="Add the word">
    </form>
</div>

<?php include "../header_footer/footer.php"; ?>