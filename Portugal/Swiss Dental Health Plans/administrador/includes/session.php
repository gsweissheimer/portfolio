<?php
   //include('db.php');
   if (!isset($_SESSION)) {
       session_start();
   }
   function curPageName()
   {
       return substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
   }

   if (!isset($_SESSION['start']) && curPageName() != 'lockscreen.php') {
       $_SESSION['start'] = true;
   //$_SESSION['LAST_ACTIVITY'] = time(); // Start activity
   } else {
       /*if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (15 * 60))) {
           session_unset();
           session_destroy();
           header('Location: lockscreen.php');
           die();
       }else{
           $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
       }*/
//       $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
   }

  if (isset($_COOKIE['usr_ck_name'])) {
      $user_name = $_COOKIE['usr_ck_name'];
  } else {
      $user_name = '';
  }
  if (isset($_COOKIE['usr_ck_user'])) {
      $user_check = $_COOKIE['usr_ck_user'];
  } else {
      $user_check = '';
  }
  if (isset($_COOKIE['usr_id'])) {
      $usr_id = $_COOKIE['usr_id'];
  } else {
      $usr_id = '';
  }
  if (isset($_COOKIE['usr_per'])) {
      $usr_per = $_COOKIE['usr_per'];
  } else {
      $usr_per = '';
  }

  if (curPageName() == 'login.php' || curPageName() == 'login-done.php') {
  } elseif (!isset($_COOKIE['usr_ck_user']) || !isset($_SESSION) || !isset($_SESSION['nameUser']) && curPageName() != 'lockscreen.php') {
//      header('location:login.php');
  }
