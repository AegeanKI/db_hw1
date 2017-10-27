<?php session_start(); ?>

<?php
  include("connect_database.php");

  if($_SESSION['account'] != null){
    if($_SESSION['is_admin'] != 1){
?>
      <div class="transport">
        <p class="alert">permission denied, only administrator can upgrade account</p>
        <meta http-equiv=REFRESH CONTENT=2;url=member.php>
      </div>
<?php
    }
    else{
      $account=$_POST['account'];
      
      $sql_find_account="UPDATE people SET is_admin=1 WHERE account='$account'";
      //$db->query($sql_find_account);
      $rs=$db->prepare($sql_find_account);
      $rs->execute();
?>
      <div class="transport">
        <p class="notice">already upgrade</p>
        <meta http-equiv=REFRESH CONTENT=1;url=admin.php>
      </div>
<?php
    }
  }
  else{
?>
    <div class="transport">
      <p class="alert">please login </p>
      <meta http-equiv=REFRESH CONTENT=1;url=index.php>
    </div>
<?php
  }
?>
<link rel="stylesheet" href="all.css">
