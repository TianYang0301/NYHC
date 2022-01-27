<?php
   include('signin.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select userID from NYHCUser where userID = '$userID' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['userID'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:signin.php");
      die();
   }
?>