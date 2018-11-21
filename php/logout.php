<?php
   session_start();
   $_SESSION['logged'] = NULL;
   if(session_destroy()) {
      header("Location: login.php");
   }
?>