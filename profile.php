<?php
    session_start();
    include "../connectdb.php";
    mysqli_select_db($db, 'fleamarket') or die(mysqli_error($db));
    if(!isset($_SESSION['userid']))
        header('Location: index.php');

    $query = "select * from users where userID='".$_SESSION['userid']."'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $user = mysqli_fetch_assoc($result);

    if(isset($_POST['username']) && $_POST['username']!==$user['userName']){
        $query = "update users set userName ='".$_POST['username']."'";
        $query .= " where userID='".$user['userID']."'";
        mysqli_query($db, $query) or die(mysqli_error($db));
        $_SESSION['username'] = $_POST['username'];
        header('Location: index.php');
    }
    if(isset($_POST['usermail']) && $_POST['usermail']!==$user['userEmail']){
        $query = "update users set userEmail ='".$_POST['usermail']."'";
        $query .= " where userID='".$user['userID']."'";
        mysqli_query($db, $query) or die(mysqli_error($db));
        header('Location: index.php');
    }
    if(isset($_POST['userpass']) && $_POST['userpass']!==""){
        $userpasshash = password_hash($_POST['userpass'], PASSWORD_DEFAULT);
        $query = "update users set userPasshash ='".$userpasshash."'";
        $query .= " where userID='".$user['userID']."'";
        mysqli_query($db, $query) or die(mysqli_error($db));
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
    <div class="main-wrap">
        <section class="post">
        <h2>Modify Profile</h2>
        <div></div>
            <form action="" method="post">
            <p>
                <label for="userid">ID</label>
                <input type="text" name="userid" id="userid"
                value=<?php echo '"'.$user['userID'].'"';?> disabled>
            </p>
            <p>
                <label for="userpass" id="newpass">New Password
                <input type="checkbox" name="passactivate" id="passactivate">
                </label>
                <input type="password" name="userpass" id="userpass" disabled>
            </p>
            <p>
                <label for="username">Name</label>
                <input type="text" name="username" id="username" 
                value=<?php echo '"'.$user['userName'].'"';?> required>
            </p>
            <p>
                <label for="usermail">Email</label>
                <input type="email" name="usermail" id="usermail" 
                value=<?php echo '"'.$user['userEmail'].'"';?> required>
            </p>
            <p class="ralign">
                <input type="submit" id="submit" value="Submit" class="btn">
            </p>
            </form>
        </section>
        <script>
            const newpass_cb = document.getElementById('passactivate');
            const newpass = document.getElementById('userpass');
            newpass_cb.onclick = function() {
                if(newpass_cb.checked)
                    newpass.removeAttribute('disabled');
                else newpass.setAttribute('disabled',"");
            }
        </script>
    </div>
</body>
</html>