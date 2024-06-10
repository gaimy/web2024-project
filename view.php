<?php
    session_start();
    include "../connectdb.php";
    mysqli_select_db($db, 'fleamarket') or die(mysqli_error($db));
    
    
    /* Article fetch */
    $query = "select * from articles where articleID=".$_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $article = mysqli_fetch_assoc($result);

    /* bookmarked check */
    if(isset($_SESSION['userid'])){
        if(isset($_GET['bookmark'])){
            $query = "insert into bookmarks values('";
            $query.= $_SESSION['userid']."',".$_GET['id'].")";
            mysqli_query($db, $query) or die(mysqli_error($db));
            header('Location: ?id='.$_GET['id']);
        }
        if(isset($_GET['unmark'])){
            $query = "delete from bookmarks where articleID=".$_GET['id'];
            $query .= " and userID='".$_SESSION['userid']."'";
            mysqli_query($db, $query) or die(mysqli_error($db));
            header('Location: ?id='.$_GET['id']);
        }
        if(isset($_GET['remove']) && $_SESSION['userid'] === $article['uploader']){
            if(!unlink($article['thumbnail'])) die('Error deleting file');
            $query = "delete from articles where articleID=".$_GET['id'];
            mysqli_query($db, $query) or die(mysqli_error($db));
            header('Location: index.php');
        }
        $query = "select * from bookmarks where articleID=".$_GET['id'];
        $query .= " and userID='".$_SESSION['userid']."'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $bookmarked = mysqli_num_rows($result);
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
        <section class="articleview">
            <?php
            echo '<div class="item-imgwrap">';
            echo '<img src='.$article['thumbnail'].'></div>';
            echo '<p class="item-title">'.$article['title'].'</p>';
            echo '<hr><p class="item-category">'. ucfirst($article['category']).'</p>';
            echo '<p class="item-desc">'. $article['content'].'</p>';
            echo '<footer><div>';
            echo '<p class="item-author">'. $article['uploader'].'</p>';
            echo '<p class="item-date">'. $article['uploadDate'].'</p></div>';
            echo '<div class="menu">';
            if(isset($_SESSION['userid'])){
                if($bookmarked) echo button('?id='.$_GET['id'].'&unmark','Unmark');
                else echo button('?id='.$_GET['id'].'&bookmark','Bookmark');
                if($article['uploader']===$_SESSION['userid']){
                    echo button('?id='.$_GET['id'].'&remove', "Remove");
                }
            }
            echo '</div></footer>';
            ?>
        </section>
    </div>
</body>
</html>