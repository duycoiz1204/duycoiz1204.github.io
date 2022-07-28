<?php
    require_once("connect_database.php");

    $id = isset($_GET["id"]) ? $_GET["id"] : "";

    if(!empty($id)) {
        $conn = connectDatabase();
        $sql = "DELETE FROM news
                WHERE id = '$id'";

        if(mysqli_query($conn, $sql)) {
            echo "Record deleted successfully";
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    header("Location: ../index.php");
?>