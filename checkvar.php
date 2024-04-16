<?php
    echo "<p>".isset($_GET['d'])."</p>";
      foreach ($_GET as $key => $value) {
          echo "<p>$key : ".$value." </p>";
      }
      echo '<hr>';
      foreach ($_SESSION as $key => $value) {
          echo "<p>$key : ".$value." </p>";
      }
      echo '<hr>';
      foreach ($_COOKIE as $key => $value) {
        echo "<p>$key : ".$value." </p>";
    }
      echo '<hr>';
      foreach ($_POST as $key => $value) {
        echo "<p>$key : ".$value." </p>";
    }