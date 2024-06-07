<?php 
function button($href, $text){
    return "<a href='$href' class='btn'><p>$text</p></a>";
}
?>
<a id="logo" href="index.php">
    <h3>Flea Market</h3>
</a>
<div class="menu">
    <?php
    if(isset($_SESSION['userid'])){
        echo "<p class='profile'>Hi, <a href='profile.php'>{$_SESSION['username']}</a>!</p>";
        echo button('index.php?logout','Logout');
        echo button('upload.php','Upload');
    }else{
        echo button('login.php','Login');
        echo button('register.php','Register');
    }
    ?>
</div>