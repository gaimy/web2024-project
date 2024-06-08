<?php
    session_start();
    if(isset($_GET['logout'])){
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        header('Location: index.php');
    }
    include "../connectdb.php";
    mysqli_select_db($db, 'fleamarket') or die(mysqli_error($db));
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
            $query = "select * from articles ";
            if($_GET['category'] === "bookmarks")
                $query .= "join bookmarks using(articleID) ";

            $query .= "where title like '%".$_GET['keyword']."%' ";
            if($_GET['category'] === "bookmarks")
                $query .= "and userID ='".$_SESSION['userid']."'";
            else if($_GET['category'] === "myitems")
                $query .= "and uploader ='". $_SESSION['userid']."'";
            else if($_GET['category'] !== "all")
                $query .= "and category ='". $_GET['category']."'";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            if(mysqli_num_rows($result) == 0) echo "<p> There is no articles </p>";
            else{
            while($row = mysqli_fetch_assoc($result)){
                if(strlen($row['content']) >= 40){
                    $row['content'] = substr($row['content'],0,100)."...";
                }
                $itemwrap = '<article class="item-wrap" >';
                $itemwrap .= '<a class="item-link" href="view.php?id='.$row['articleID'];
                $itemwrap .= '"><div class="item-imgwrap"><img src='.$row['thumbnail'];
                $itemwrap .= '></div><div class="item-content"><p class="item-title">'.$row['title'];
                $itemwrap .= '</p><p class="item-desc">'.$row['content'];
                $itemwrap .= '</p><p class="item-author">'.$row['uploader'];
                $itemwrap .= '</p><p class="item-date">'.$row['uploadDate'];
                $itemwrap .= '</p></div></a></article>';
                echo $itemwrap;
            }}
        ?>
        </section>
    </div>
</body>
</html>