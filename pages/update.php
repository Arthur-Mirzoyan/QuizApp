<?php
    $data = getWord($_SESSION['ID']);
?>

<link rel="stylesheet" href="../style/add.css">
<div id="ADD">
    <div class="container">
        <form action="../connection/action.php" method="post">
            <input type="text" name="word" placeholder="Word" value="<?php echo $data["word"]; ?>" required>
            <input id="lesson" type="text" name="lesson" placeholder="Lesson" value="<?php echo $data["lesson"]; ?>"
                required>
            <textarea wrap="soft" rows="15" name="explanation" placeholder="Explanation"
                required><?php echo $data["explanation"]; ?></textarea>
            <input id="addBtn" type="submit" name="update" value="Update the word">
        </form>
    </div>
</div