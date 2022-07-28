<?php
require_once("api/connect_database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form update</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    $id = isset($_GET["id"]) ? $_GET["id"] : "";

    if(!empty($id)) {
        $conn = connectDatabase();
        $sql = "SELECT * FROM news
                WHERE ID = $id";
        $arrData = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($arrData);
        mysqli_close($conn);
    }

    ?>
    <div class="container">
        <div class="frame-form">
            <!-- Header -->
            <header class="frame-form-header">
                <h2>Update</h2>
            </header>

            <!-- Form -->
            <div class="frame-form-content">
                <form onsubmit="return checkForm()" action="api/update_new.php" method="post">
                    <!-- Id update -->
                    <input type="hidden" name="id" id="id" value="<?= $id ?>">

                    <!-- Input title -->
                    <div class="input-group">
                        <label for="title">Title</label> <span class="icon-required">*</span>
                        <input type="text" name="title" id="title" value="<?= $data["title"] ?>">
                        <span id="error-title" class="error"></span>
                    </div>

                    <!-- Input content -->
                    <div class="input-group">
                        <label for="content">Content</label> <span class="icon-required">*</span>
                        <textarea name="content" id="content" rows="10"><?= $data["content"] ?></textarea>
                        <span id="error-content" class="error"></span>
                    </div>
                    
                    <!-- Input link image -->
                    <div class="input-group">
                        <label for="link-image">Link image</label> <span class="icon-required">*</span>
                        <input type="text" name="link-image" id="link-image" value="<?= $data["link-image"] ?>">
                        <span id="error-link-image" class="error"></span>
                    </div>

                    <!-- button group -->
                    <div class="button-group" style="text-align:center;">
                        <button type="submit" id="input-button">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>