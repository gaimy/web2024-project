<?php
  setcookie('username','jo',time()+3600);
  session_start();
  $_SESSION['allow'] = $_GET['allow'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>php test</title>
  </head>
  <body>
    <?php
      // $r = "";
      $dr = "vslue";
      echo "asdf $dr dddd";
      echo "<p>";
      if (isset($_GET['d'])) {
        echo "d check";
      } else {
        echo "d not";
      }
      $text = <<<TEXT
      $dr, $dr wow.\n
      2nd "dd" line
      TEXT;
      echo $text;
      echo "</p>";
    ?>
    <?php  include 'checkvar.php' ?>
    <hr>
    <li><a href="/program.php">go program</a></li>
    <li><a href="/sort.php">go sort</a></li>
    <form action="/program.php" method="post">
      <label for="pt">dd</label>
      <input type="text" name="pt" id="pt">
      <input type="submit" value="submit">
    </form>
  </body>
</html>