<?php
    session_start();
    include "../connectdb.php";
    if(isset($_GET['logout'])){
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        header('Location: index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <title>Flea Market</title>
</head>
<body>
    <header>
        <?php require "module/header.php";?>
    </header>
    <?php require "module/search.php";?>
    <div class="main-wrap">
        <section class="articles-wrap">
            <?php
                foreach ($_POST as $key => $value) {
                    echo "<div>$key => $value</div>";
                }
            ?>
            <article class="item-wrap" >
                <a class="item-link" href="/view.php?id=0001">
                    <img src="" alt="">
                    <p class="item-title">팔아요</p>
                    <p class="item-price">100원</p>
                    <p class="item-desc"></p>
                </a>
            </article>
        </section>
    </div>
</body>
</html>