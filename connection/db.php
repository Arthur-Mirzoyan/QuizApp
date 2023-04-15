<?php

    function openConn() {
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'quiz';

        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        return $conn;
    }

    function closeConn($conn) {
        $conn -> close();
    }

?>