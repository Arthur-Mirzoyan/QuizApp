<?php

    include "methods.php";

    if (isset($_POST["add"])) addWord($_POST['word'], $_POST['explanation'], $_POST['lesson']);
    
    else if (isset($_POST["change"])) {
        $_SESSION['ID'] = $_POST["change"];
        header("location:../pages/update.php");
    }

    else if (isset($_POST["delete"])) deleteWord($_POST["delete"]);

    else if (isset($_POST["deleteAll"])) deleteWordsFromLesson($_POST["lesson"]);
    
    else if (isset($_POST["update"])) updateWord($_POST['word'], $_POST['explanation'], $_POST['lesson']);

    else if (isset($_POST["create"])) {
        $_SESSION['WORDS'] = getRandomWords($_POST["count"], $_POST["lesson"]);
        header("location:../pages/quiz.php");
    }

    else if (isset($_POST["check"])) checkAnswers($_SESSION["WORDS"], $_SESSION["VARIANTS"], $_POST["answer"]);

?>