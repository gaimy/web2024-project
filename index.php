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
    <div class="search">
        <form action="" method="post">
            <select name="category" id="category">
                <option value="books">Books</option>
                <option value="furnitures">Furnitures</option>
                <option value="electronics">Electronics</option>
                <option value="etc">Etc.</option>
            </select>
            <input type="search" name="keyword" id="squery">
        </form>
    </div>
    <div class="main-wrap">
        <section>
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