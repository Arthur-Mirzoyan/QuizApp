<?php 

    include "../header_footer/header.php";
    $data = getWords();
    $lessons = getLessons();

?>

<link rel="stylesheet" href="../style/main.css">
<div class="container">
    <?php 
        if(empty($data)) echo "<h1>No Words Found.</h1>";
        else { 
    ?>
    <table cellspacing="0">
        <tr id="tableHeader">
            <th>Word</th>
            <th id="explanation">Explanation</th>
            <th>Lesson</th>
            <th>Change</th>
        </tr>
        <?php
            foreach($data as $rows) { 
        ?>
        <tr>
            <th><?php echo ucfirst($rows['word']); ?></th>
            <th><?php echo ucfirst($rows['explanation']); ?></th>
            <th><?php echo ucfirst($rows['lesson']); ?></th>
            <th>
                <form action="../connection/action.php" method="post">
                    <button id="changeBtn" type="submit" name="change"
                        value="<?php echo ucfirst($rows['id']); ?>"></button>
                    <button id="deleteBtn" type="submit" name="delete"
                        value="<?php echo ucfirst($rows['id']); ?>"></button>
                </form>
            </th>
        </tr>
        <?php } ?>
        <tr>
            <th></th>
            <th>Delete All Words From Lesson >>></th>
            <th>
                <form action="../connection/action.php" method="post">
                <select id="lesson" class="secondCol" name="lesson">
                    <option value="all">All</option>
                    <?php
                        if (!empty($lessons)) {
                            foreach($lessons as $rows) {
                    ?>
                    <option value="<?php echo $rows['lesson']?>"><?php echo $rows['lesson'] ?></option>
                    <?php }} ?>
                </select>
            </th>
            <th>
                    <button id="deleteAllBtn"  type="submit" name="deleteAll">DELETE</button>
                </form>
            </th>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include "../header_footer/footer.php"; ?>