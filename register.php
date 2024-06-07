<?php
    session_start();
    if(isset($_SESSION['userid']))
        header('Location: index.php');


    require "../connectdb.php";
    mysqli_select_db($db, 'fleamarket') or die(mysqli_error($db));

    if(isset($_POST['userid'])){

        // WARNING : SQL injection weak - need escape
        $userid = $_POST['userid'];
        $username = $_POST['username'];
        $userpasshash = password_hash($_POST['userpass'], PASSWORD_DEFAULT);
        $usermail = $_POST['usermail'];

        $query = "select userid from users where userid='$userid'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $redup = mysqli_num_rows($result);
        if($redup == 0){
            $query = "insert into users values('$userid','$username','$usermail','$userpasshash')";
            mysqli_query($db, $query) or die(mysqli_error($db));
            header('Location: index.php');
        }
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
    <div class="main-wrap">
        <section class="post">
            <h2>Register</h2>
            <form action="" method="post">
            <p>
                <label for="userid">ID</label>
                <input type="text" name="userid" id="userid" required>
            </p>
            <p>
                <label for="userpass">Password</label>
                <input type="password" name="userpass" id="userpass" required>
            </p>
            <p>
                <label for="username">Name</label>
                <input type="text" name="username" id="username" required>
            </p>
            <p>
                <label for="usermail">Email</label>
                <input type="email" name="usermail" id="usermail" required>
            </p>
            <?php if(isset($redup)&&$redup)
            echo "<p class='error'>ID is already taken</p>"; ?>
            <p class="ralign">
                <input type="submit" id="submit" value="Submit" class="btn">
            </p>
            </form>
        </section>
    </div>
</body>
</html>