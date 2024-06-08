<?php
    if(!isset($_GET['category'])) $_GET['category'] = "all";
    if(!isset($_GET['keyword'])) $_GET['keyword'] = "";
?>
<div class="search">
    <form action="index.php" method="get">
        <select name="category" id="category">
            <option value="all" <?php if($_GET['category']==="all") echo 'selected'?>>All</option>
            <option value="books" <?php if($_GET['category']==="books") echo 'selected'?>>Books</option>
            <option value="furnitures" <?php if($_GET['category']==="furnitures") echo 'selected'?>>Furnitures</option>
            <option value="electronics" <?php if($_GET['category']==="electronics") echo 'selected'?>>Electronics</option>
            <option value="clothing" <?php if($_GET['category']==="clothing") echo 'selected'?>>Clothing</option>
            <option value="etc" <?php if($_GET['category']==="etc") echo 'selected'?>>Etc.</option>
            <?php if(isset($_SESSION['userid'])){
                echo '<option value="bookmarks" ';
                if($_GET['category']==="bookmarks") echo 'selected';
                echo '>Bookmarks</option>';
                echo '<option value="myitems" ';
                if($_GET['category']==="myitems") echo 'selected';
                echo '>My Items</option>';
            }?>
        </select>
        <input type="search" name="keyword" id="squery"
        value=<?php echo $_GET['keyword']; ?>>
    </form>
</div>