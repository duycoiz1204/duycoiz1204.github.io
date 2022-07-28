<?php
    require_once("connect_database.php");

    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $title = isset($_POST["title"]) ? $_POST["title"] : "";
    $content = isset($_POST["content"]) ? $_POST["content"] : "";
    $linkImage = isset($_POST["link-image"]) ? $_POST["link-image"] : "";

    if(!empty($id) && !empty($title) && !empty($content) && !empty($linkImage)) {
        $conn = connectDatabase();
        $sql = "UPDATE news
                SET `title` = '$title',
                    `content` = '$content',
                    `link-image` = '$linkImage'
                WHERE `id` = '$id'";
        
        if(mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    }
    header("Location: ../index.php");
?>