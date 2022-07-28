<?php
require_once("api/connect_database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e283640b2f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Index</title>
</head>

<body style="background-image:linear-gradient(to right, #83a4d4, #b6fbff);">
    <?php
    $search = isset($_GET["search"]) ? $_GET["search"] : "";    // get key search

    $conn = connectDatabase();  // connect database

    $sql = "SELECT count(*) FROM news
            WHERE title like '%$search%'";
    $arr_data = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($arr_data);
    $numberOfNews = $data["count(*)"];  // number of news

    $numberOfNewsPerPage = 3;   // number of news per page
    $numberOfPages = ceil($numberOfNews / $numberOfNewsPerPage);  // number of pages
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;   // get current page

    // get listing page to display
    if ($page == 1 || $numberOfPages - 2 < 1)
        $listingPage = 1;
    else if ($page == $numberOfPages)
        $listingPage = $numberOfPages - 2;
    else
        $listingPage = $page - 1;

    $numberOfIgnoredNews = $numberOfNewsPerPage * ($page - 1); // number of ignored news

    $sql = "SELECT * FROM news
            WHERE title like '%$search%'
            LIMIT $numberOfNewsPerPage OFFSET $numberOfIgnoredNews";
    $arr_data = mysqli_query($conn, $sql);
    mysqli_close($conn);
    ?>

    <div class="container">
        <div class="frame-table">
            <div class="frame-table-header">
                <div class="frame-table-brand" onclick="window.location='?'">
                    <h2 style="display:inline-block">Hot news</h2>
                    <span class="pill"><?= $numberOfNews ?> news</span>
                </div>

                <div class="frame-table-function">
                    <form action="">
                        <input type="search" class="search-input" name="search" placeholder="Search">
                    </form>
                    <button type="button" class="input-button" onclick="location.href='form_create.html'">+ Add new</button>
                </div>
            </div>

            <div class="frame-table-content">
                <table class="table" style="text-align:center;">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th></th>
                    </tr>
                    <?php foreach ($arr_data as $data) { ?>
                        <tr>
                            <td><?= $data["ID"] ?></td>
                            <td onclick="location.href='api/news.php?id=<?= $data['ID'] ?>'"><?= $data["title"] ?></td>
                            <td><img src="<?= $data["link-image"] ?>" style="width:200px"></td>
                            <td class="table-groups-button">
                                <i class="fa-regular fa-trash-can" onclick="window.location='api/delete_new.php?id=<?= $data['ID'] ?>'"></i>
                                <i class="fa-regular fa-pen-to-square" onclick="window.location='form_update.php?id=<?= $data['ID'] ?>'"></i>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <div class="frame-table-footer">
                <div class="pagination">
                    <a href="#" class="prev" onclick="prevPage()">< Prev</a>
                    <?php for ($i = $listingPage; $i <= $numberOfPages && $i <= $listingPage + 2; $i++) { ?>
                    <a href="?page=<?= $i ?>" class="index"><?= $i ?></a>
                    <?php } ?>
                    <a href="#" class="next" onclick="nextPage()">Next ></a>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>