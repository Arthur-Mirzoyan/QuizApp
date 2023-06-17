<?php include "../connection/methods.php"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style/colors.css">
        <link rel="stylesheet" href="../style/header.css">
        <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
        <title>Learn with me</title>
        <script src="../script.js"></script>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a class="<?php echo isPageActive("main.php") ?>" href="./main.php">Words</a></li>
                    <li><a class="<?php echo isPageActive("tests.php") ?>" href="./tests.php">Tests</a></li>
                </ul>
                <?php if(isPageActive("main.php")) { ?>
                <ul id="add">
                    <li><button onclick="toggleModal()"><img src="./../img/add.png" alt="Add"></button></li>
                </ul>
                <?php } ?>
            </nav>
        </header>
        <div class="wrapper">