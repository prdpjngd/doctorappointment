<?php
session_start();

if(isset($_SESSION['uid'])) {
  session_destroy();
  unset($_SESSION['uid']);
  header("Location: index.php");
} else {
  header("Location: index.php");
}
?>