<?php
  function funTreat(){
    include_once('class/class.notifications.php');
    $notifications = notifications::getInstance();
    $viTitle = $_SESSION['title'];
    $viDescription = $_SESSION['description'];
    $viTypeError = $_SESSION['typeError'];
    echo $notifications->execute($viTypeError,$viTitle,$viDescription);
    unset($_SESSION['title']);
    unset($_SESSION['description']);
    unset($_SESSION['typeError']);
  }

  if(isset($_SESSION['title'])){
    funTreat();
  }
?>
