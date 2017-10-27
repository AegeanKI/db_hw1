<?php session_start(); ?>

<?php
  unset($_SESSION['account']);
  unset($_SESSION['is_admin']);
?>
  <div class="transport">
    <p class="notice">logging out...</p>
    <meta http-equiv=REFRESH CONTENT=1;url=index.php>
  </div>
<link rel="stylesheet" href="all.css">
