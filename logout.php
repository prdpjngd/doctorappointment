<?php
session_start();

if(isset($_SESSION['p_id'])) {
  session_destroy();
  unset($_SESSION['p_id']);
  header("Location: index.php");
} else {
  header("Location: index.php");
}
?>