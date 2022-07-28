<?php
    require_once("connect_database.php");

    $title = isset($_POST["title"]) ? $_POST["title"] : "";
    $content = isset($_POST["content"]) ? $_POST["content"] : "";
    $linkImage = isset($_POST["link-image"]) ? $_POST["link-image"] : "";

    if(!empty($title) && !empty($content) && !empty($linkImage)) {
        $conn = connectDatabase();
        $sql = "INSERT INTO news(`title`, `content`, `link-image`)
                VALUES ('$title', '$content', '$linkImage')";
        
        if(mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    }
    header("Location: ../index.php");
?>