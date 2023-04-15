<?php

    include "db.php";
    session_start();

    function addWord($word, $explanation, $lesson) {
        $conn = openConn();
        $lesson = changeStringStyle($lesson);

        if (!lessonExists($conn, $lesson)) addLesson($conn, correctStringStyle($lesson));
        
        $lesson = correctStringStyle($lesson);
        $word = trim($word);
        $explanation = trim($explanation);
        $sql = "INSERT INTO words VALUES (null, '$word', '$explanation', '$lesson')";

        mysqli_query($conn, $sql);

        closeConn($conn);
        header("location:../pages/add.php");
    }

    function getWords($lesson = "all") {
        $conn = openConn();
        $sql = "SELECT * FROM words ORDER BY lesson";    
        
        $response = mysqli_query($conn, $sql);
        closeConn($conn);

        $data = [];

        if ($response->num_rows > 0) $data = $response->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

    function getWord($id) {
        $conn = openConn();
        $sql = "SELECT * FROM words WHERE id=$id";    
        
        $response = mysqli_query($conn, $sql);
        closeConn($conn);

        $result = [];

        if ($response->num_rows > 0) $result = mysqli_fetch_assoc($response);

        if (empty($data)) return $result;
        return $result;
    }

    function getLessons() {
        $conn = openConn();
        $sql = "SELECT * FROM `lessons` ORDER BY `lesson`";
        $result = [];

        $response = mysqli_query($conn, $sql);
        closeConn($conn);

        if ($response->num_rows > 0) $result = $response->fetch_all(MYSQLI_ASSOC);
        
        return $result;
    }

    function addLesson($conn, $lesson) {
        $sql = "INSERT INTO lessons VALUES ('$lesson')";
        mysqli_query($conn, $sql);
    }

    function lessonExists($conn, $lesson) {
        $sql = "SELECT lesson FROM lessons";
        $lessons = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($lessons)) {
            if ($lesson == changeStringStyle($row["lesson"])) return true;
        }

        return false;
    }

    function changeStringStyle($string) {
        return preg_replace("/[^a-zA-Z0-9]/", "", strtolower($string));
    }

    function correctStringStyle($string) {
        if (str_contains($string, "lesson")) return substr_replace(ucfirst($string), " ", 6, 0);
        return ucfirst($string);
    }

    function isPageActive($pageName) {
        if (basename($_SERVER['PHP_SELF']) == $pageName) return "active";
        return "";
    }

    function deleteWord($id) {
        $id = (int)$id;
        $conn = openConn();
        $sql = "DELETE FROM words WHERE id=$id";

        $word = getWord($id);
        mysqli_query($conn, $sql);

        if (getWordsNumberByLesson($word["lesson"]) == 0) deleteLesson($word["lesson"]);

        closeConn($conn);
        header("location:../pages/main.php");
    }

    function deleteLesson($lesson = "all") {
        $conn = openConn();
        $sql = "DELETE FROM lessons where lesson like '$lesson'";

        if ($lesson == "all") $sql = "TRUNCATE TABLE lessons";
        
        mysqli_query($conn, $sql);

        closeConn($conn);
    }

    function deleteWordsFromLesson($lesson = "all") {
        $conn = openConn();
        $sql = "DELETE FROM words WHERE lesson='$lesson'";
        
        if ($lesson == "all") $sql = "TRUNCATE TABLE words";

        deleteLesson($lesson);

        mysqli_query($conn, $sql);

        closeConn($conn);
        header("location:../pages/main.php");
    }

    function updateWord($word, $explanation, $lesson) {
        $conn = openConn();
        $id = $_SESSION['ID'];
        $oldLesson = getWord($id)["lesson"];
        $lesson = changeStringStyle($lesson);
        
        if (!lessonExists($conn, $lesson)) addLesson($conn, correctStringStyle($lesson));

        $lesson = correctStringStyle($lesson);
        $sql = "UPDATE words SET word='$word', explanation='$explanation', lesson='$lesson' WHERE id=$id";

        mysqli_query($conn, $sql);

        if ($lesson != $oldLesson && getWordsNumberByLesson($oldLesson) == 0) deleteLesson($oldLesson);

        closeConn($conn);
        unset($_SESSION['ID']);
        header("location:../pages/main.php");
    }

    function getRandomWords($count, $lesson) {
        $conn = openConn();
        $result = [];

        if ($cout > getWordsNumberByLesson($lesson)) $count = getWordsNumberByLesson($lesson);

        echo $count;

        $sql = "SELECT * FROM words WHERE lesson LIKE '$lesson' ORDER BY RAND() LIMIT $count";

        if ($lesson == "all") $sql = "SELECT * FROM words ORDER BY RAND() LIMIT $count";

        $result = mysqli_query($conn, $sql)->fetch_all(MYSQLI_ASSOC);
        
        closeConn($conn);
        return $result;
    }

    function getWordsNumberByLesson($lesson = "all") {
        $conn = openConn();
        $sql = "SELECT COUNT(*) AS total FROM words WHERE lesson LIKE '$lesson'";

        if ($lesson == "all") $sql = "SELECT COUNT(*) AS total FROM words";

        $response = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($response);

        return $result["total"];
    }

    function createRandomList($array) {
        $length = count($array) - 1;
        $words = range(0, $length);
        $explanations = range(0, $length);

        shuffle($explanations);
        shuffle($words);

        return array_combine($words, $explanations);
    }

    function checkAnswers($words, $variants, $answers) {
        $total = count($words);
        $correctAnswers = 0;
        $question = 0;

        foreach($variants as $word => $explanation) {
            if (($explanation == $word && $answers[$question] == 'T')
                || ($explanation != $word && $answers[$question] == 'F')) $correctAnswers++;

            $question++;
        }

        $_SESSION["SCORE"] = array(
            "words" => $words,
            "variants" => $variants,
            "answers" => $answers,
            "percentage" => ((int)($correctAnswers / $total * 10000)) / 100,
            "correctAnswers" => $correctAnswers,
            "totalQuestions" => $total
        );

        header("location:../pages/answers.php");
    }
?>