<?php session_start(); ?>

<?php
  include("connect_database.php");

  if($_SESSION['account'] != null){
    if($_SESSION['is_admin'] != 1){
      echo 'permission denied, only administrator can upgrade account<br>';
      echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
    }
    else{
      $account=$_POST['account'];
      
      $sql_find_account="UPDATE people SET is_admin=1 WHERE account='$account'";
      //$db->query($sql_find_account);
      $rs=$db->prepare($sql_find_account);
      $rs->execute();
      echo 'already upgrade<br>';
      echo '<meta http-equiv=REFRESH CONTENT=1;url=admin.php>';
    }
  }
  else{
    echo 'please login <br>';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
  }
?>
