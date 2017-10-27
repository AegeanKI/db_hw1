<?php session_start(); ?>

<?php
  unset($_SESSION['account']);
  unset($_SESSION['is_admin']);
  echo 'logout...';
  echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
?>
<link rel="stylesheet" href="all.css">
