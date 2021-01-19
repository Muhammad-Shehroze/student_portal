<?php
  require_once 'include/config.php';
  require_once 'include/header.php';
  require_once 'include/sidebar.php';
  if(!isset( $_SESSION['admin_user']))
    header("location: index.php");
  ?>
<div class="main">
  <h3>Welcome to Dashboard</h3>
</div>
<footer>
<?php
  require_once 'include/footer.php';
?>
</footer>