<?php
    function connectDatabase() {
        $conn = mysqli_connect("localhost", "root", "", "self-study");
        if(!$conn)
            die("Connection failed: " . mysqli_connect_error());
        
        mysqli_set_charset($conn, "utf8");
        return $conn;
    }
?>