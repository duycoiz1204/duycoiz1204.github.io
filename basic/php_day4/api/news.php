<?php
require_once("connect_database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>New</title>
</head>

<body>
    <?php
    $id = isset($_GET["id"]) ? $_GET["id"] : "";
    if (!empty($id)) {
        $conn = connectDatabase();
        $sql = "SELECT * FROM news WHERE id = $id";
        $arr_data = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($arr_data);
        mysqli_close($conn);
    }
    ?>

    <div class="container">
        <div class="frame-news">
            <div class="frame-news-header">
                <h1><?= $data["title"] ?></h1>
            </div>

            <div class="frame-news-content">
                <img src="<?= $data["link-image"] ?>" alt="" style="display:block;width:500px">
                <?= nl2br($data["content"]) ?>
            </div>
        </div>
    </div>
</body>

</html>