<?php
  if(!isset($_COOKIE['usr_ck_user']) || !isset($_SESSION['nameUser'])){
     header("location:login.php");
  }else{
    header("location:dashboard.php");
  }
?>
