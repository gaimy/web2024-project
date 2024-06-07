<?php
    session_start();
    include "../connectdb.php";

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
        <section class="articleview">
            
        </section>
    </div>
</body>
</html>