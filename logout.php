<?php
   require_once 'include/config.php';
   unset($_SESSION['admin_user']);
      session_destroy();
      header('Refresh: 0; URL = index.php');
?>