<?php
    session_start();
    if(isset($_SESSION['userid']))
        header('Location: index.php');

    require "../connectdb.php";
    mysqli_select_db($db, 'fleamarket') or die(mysqli_error($db));

    // WARNING : SQL injection weak - need escape
    if(isset($_POST['userid'])){
    $userid = $_POST['userid'];
    $userpass = $_POST['userpass'];

    $query = "select * from users where userid='$userid'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $result = mysqli_fetch_assoc($result);

    if(isset($result['userID'])){
        $auth = password_verify($userpass,$result['userPasshash']);
    }else{
        $auth = 0; // no id;
    }
    if($auth){
        $_SESSION['userid'] = $result['userID'];
        $_SESSION['username'] = $result['userName'];
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
        <section class="login post">
            <h2>Login</h2>
            <form action="" method="post">
                <p>
                    <label for="userid">ID</label>
                    <input type="text" name="userid" id="userid" required>
                </p>
                <p>
                    <label for="userpass">Password</label>
                    <input type="password" name="userpass" id="userpass" required>
                </p>
                <?php if(isset($auth)&&!$auth)
                echo "<p class='error calign'>Wrong ID or Password</p>"; ?>
                <p class="calign">
                    <input type="submit" id="submit" value="Login" class="btn">
                </p>
            </form>
        </section>
    </div>
</body>
</html>